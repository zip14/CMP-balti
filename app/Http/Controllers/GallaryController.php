<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GallaryCategory;
use App\Gallary;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class GallaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        return view('admin/gallary/index');
    }

    /**
     * @return JSON for Data table with all records
     */
    public function selectGallary()
    {
        $query = Gallary::select('id', 'id_category', 'title', 'created_at', 'image', 'description')->with('category');

        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    0 => 'description',
                    1 => 'title',
                    4 => 'created_at'
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'date', 'image', 'category'])
            ->addColumn('actions', 'admin/gallary/actions')
            ->addColumn('image', 'admin/gallary/image')

            ->addColumn('date', function($query){
                return date('d.m.Y', strtotime($query->created_at));
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
        return view('admin/gallary/form', ['category' => GallaryCategory::all()]);
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
            'id_category' => 'required',
            'image' => 'required',
            'description' => 'required',
            'title' => 'required',
        ]);

        $input = $request->all();

        if($request->hasFile('image')){

            $image = $request->file('image');
            $input['image'] =  uniqid() . '.' . $image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1920, 1080);
            $image_resize->save(public_path('images/gallary/' . $input['image']));
        }

        $gallary = new Gallary();
        $gallary->fill($input);
        $gallary->save();


        return response()->json([
            'message' => "Imaginea a fost adăugată"
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
        return view('admin/gallary/form', ['category' => GallaryCategory::all(), 'gallary' =>  Gallary::findOrFail($id)]);
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
            'id_category' => 'required',
            'description' => 'required',
            'title' => 'required',
        ]);

        $input = $request->all();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $input['image'] =  uniqid() . '.' . $image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1920, 1080);
            $image_resize->save(public_path('images/gallary/' . $input['image']));

            if(isset($input['old_image']) && !empty($input['old_image'])){
                File::delete(public_path() . '/images/gallary/' . $input['old_image']);
            }

        }elseif(!empty($input['old_image'])){
            $input['image'] = $input['old_image'];
        }

        $gallary = Gallary::findOrFail($id);
        $gallary->fill($input);
        $gallary->update();


        return response()->json([
            'message' => "Imaginea au fost actualizat"
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
        return view('admin/gallary/delete', Gallary::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallary = Gallary::findOrFail($id);

        if(isset($gallary['image']) && !empty($gallary['image'])){
            File::delete(public_path() . '/images/gallary/' . $gallary['image']);
        }

        $gallary->delete();

        return response()->json([
            'message' => 'Imaginea a fost șters'
        ], 200);
    }
}
