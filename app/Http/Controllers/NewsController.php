<?php

namespace App\Http\Controllers;

use App\Helpers\Alias;
use App\NewsCategory;
use Illuminate\Http\Request;
use App\News;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/news/index');
    }

    /**
     * @return JSON for Data table with all records
     */
    public function selectNews()
    {
        $query = News::select('id', 'title', 'alias', 'description', 'image', 'id_category', 'created_at')->with('category');

        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    0 => 'title',
                    4 => 'created_at'
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'date', 'image', 'category', 'titleLink', 'categoryLink'])
            ->addColumn('actions', 'admin/news/actions')
            ->addColumn('image', 'admin/news/image')

            ->addColumn('date', function($query){
                return date('d.m.Y', strtotime($query->created_at));
            })

            ->addColumn('titleLink', function($query){
                return "<a href = '" . route('fullNewsPage', ['news' => $query['alias']]) . "' target = '_blank'>" . $query['title'] . "</a>";
            })

            ->addColumn('categoryLink', function($query){
                return "<a href = '" . route('categoryNewsPage', ['category' => $query->category['alias']]) . "' target = '_blank'>" . $query->category['name'] . "</a>";
            })

            ->addColumn('category', function($query){
                return $query->category['name'];
            })

            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {
        return view('admin/news/form', ['category' => NewsCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:news',
            'content' => 'required',
            'description' => 'required',
            'id_category' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        $input['alias'] = Alias::generateAlias($input['title']);

        if($request->hasFile('image')){

            $image = $request->file('image');
            $input['image'] =  uniqid() . '.' . $image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1920, 1080);
            $image_resize->save(public_path('images/news/' . $input['image']));
        }

        $news = new News();
        $news->fill($input);
        $news->save();


        return response()->json([
            'message' => "Au fost adăugate știri"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
        return view('admin/news/form', ['category' => NewsCategory::all(), 'news' =>  News::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:news,title,'.$request['id'],
            'content' => 'required',
            'description' => 'required',
            'id_category' => 'required',
        ]);

        $input = $request->all();

        $input['alias'] = Alias::generateAlias($input['title']);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $input['image'] =  uniqid() . '.' . $image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1920, 1080);
            $image_resize->save(public_path('images/news/' . $input['image']));

            if(isset($input['old_image']) && !empty($input['old_image'])){
                File::delete(public_path() . '/images/news/' . $input['old_image']);
            }

        }elseif(isset($input['old_image']) && !empty($input['old_image'])){
            $input['image'] = $input['old_image'];
        }

        $news = News::findOrFail($id);
        $news->fill($input);
        $news->update();


        return response()->json([
            'message' => "Știri au fost actualizat"
        ], 201);

    }

    /**
     * Show the form for deleting a resource.
     *
     * @param  int  $id
     * @return view
     */
    public function delete($id)
    {
        return view('admin/news/delete', News::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if(isset($news['image']) && !empty($news['image'])){
            File::delete(public_path() . '/images/news/' . $news['image']);
        }

        $news->delete();

        return response()->json([
            'message' => 'Știrile au fost șterse'
        ], 200);
    }
}
