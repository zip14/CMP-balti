<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use File;


class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/specialty/index');

    }

    public function selectSpecialty()
    {
        $query = Specialty::select('id', 'name', 'description', 'image', 'schedule_link', 'created_at');


        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    0 => 'name',
                    4 => 'created_at'
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'date', 'image', 'orar_link'])
            ->addColumn('actions', 'admin/specialty/actions')
            ->addColumn('image', 'admin/specialty/image')

            ->addColumn('date', function($query){
                return date('d.m.Y', strtotime($query->created_at));
            })

            ->addColumn('orar_link', function($query){
//                return $query->category['name'];
                return "<a href='{$query->schedule_link}' target='_blank'>Orar({$query->name})</a>";
            })

            ->toJson();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/specialty/form');

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
            'name' => 'required',
            'alias' => 'required|unique:specialities',
            'content' => 'required',
            'description' => 'required',
            'schedule_link' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $input['image'] = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/images/specialty/', $input['image']);

        }

        $specialty = new Specialty();
        $specialty->fill($input);
        $specialty->save();


        return response()->json([
            'message' => "Specialitatea a fost adăugată"
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin/specialty/form', Specialty::findOrFail($id));

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
            'alias' => 'required|unique:specialities,alias,'.$request['id'],
            'content' => 'required',
            'description' => 'required',
            'schedule_link' => 'required',
        ]);

        $input = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $input['image'] = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/images/specialty', $input['image']);

            if(isset($input['old_image']) && !empty($input['old_image'])){
                File::delete(public_path() . '/images/specialty/' . $input['old_image']);
            }

        }elseif(isset($input['old_image']) && !empty($input['old_image'])){
            $input['image'] = $input['old_image'];
        }

        $specialty = Specialty::findOrFail($id);
        $specialty->fill($input);
        $specialty->update();


        return response()->json([
            'message' => "Specialitatea a fost actualizată"
        ], 201);
    }


    public function delete($id)
    {
        return view('admin/specialty/delete', Specialty::findOrFail($id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);

        if(isset($specialty['image']) && !empty($specialty['image'])){
            File::delete(public_path() . '/images/specialty/' . $specialty['image']);
        }

        $specialty->delete();

        return response()->json([
            'message' => 'Specialitatea a fost eliminată'
        ], 200);
    }
}
