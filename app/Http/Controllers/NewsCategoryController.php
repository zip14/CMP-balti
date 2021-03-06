<?php

namespace App\Http\Controllers;

use App\Helpers\Alias;
use App\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/newsCategory/index');
    }

    /**
     * @return JSON for Data table with all records
     */
    public function selectCategories()
    {

        $query = NewsCategory::select('id', 'name', 'alias', 'created_at');

        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    0 => 'name',
                    1 => 'created_at'
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'date', 'nameLink'])
            ->addColumn('actions', 'admin/newsCategory/actions')

            ->addColumn('nameLink', function($query){
                return "<a href = '" . route('categoryNewsPage', ['category' => $query['alias']]) . "' target = '_blank'>" . $query['name'] . "</a>";
            })

            ->addColumn('date', function($query){
                return date('d.m.Y', strtotime($query->created_at));
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
        return view('admin/newsCategory/form');
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
            'name' => 'required|unique:news_categories',

        ]);

        $input = $request->all();

        $input['alias'] = Alias::generateAlias($input['name']);

        $category = new NewsCategory();
        $category->fill($input);
        $category->save();

        return response()->json([
            'message' => "Categoria a fost adăugată"
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
        return view('admin/newsCategory/form', NewsCategory::findOrFail($id));
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
            'name' => 'required|unique:news_categories,name,'.$request['id'],
        ]);

        $input = $request->all();

        $input['alias'] = Alias::generateAlias($input['name']);

        $category = NewsCategory::findOrFail($id);
        $category->fill($input);
        $category->update();

        return response()->json([
            'message' => "Categoria a fost actualizata"
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
        return view('admin/newsCategory/delete', NewsCategory::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = NewsCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Сategoria a fost ștearsă'
        ], 200);
    }
}
