<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GallaryCategory;
class GallaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        return view('admin/gallaryCategory/index');
    }

    /**
     * @return JSON for Data table with all records
     */
    public function selectCategories()
    {

        $query = GallaryCategory::select('id', 'name', 'created_at');

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
            ->rawColumns(['actions', 'date'])
            ->addColumn('actions', 'admin/gallaryCategory/actions')

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
        return view('admin/gallaryCategory/form');
    }

    /**
     * Store resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        $category = new GallaryCategory();
        $category->fill($input);
        $category->save();

        return response()->json([
            'message' => "Categoria a fost adăugată"
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
        return view('admin/gallaryCategory/form', GallaryCategory::findOrFail($id));
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
            'name' => 'required',
        ]);

        $category = GallaryCategory::findOrFail($id);
        $category->fill($request->all());
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
        return view('admin/gallaryCategory/delete', GallaryCategory::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $category = GallaryCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Сategoria a fost ștearsă'
        ], 200);

    }
}
