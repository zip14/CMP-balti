<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alias;
use App\Team;
use File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/team/index');

    }

    /**
     * select list of the person team.
     *
     * @return JSON for DataTable
     */
    public function selectPerson()
    {
        $query = Team::select('id', 'name', 'alias', 'position', 'education', 'image', 'created_at');

        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    1 => 'name',
                    2 => 'position',
                    3 => 'education',
                    4 => 'created_at',
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'nameSurname', 'image', 'date'])

            ->addColumn('image', 'admin/team/image')
            ->addColumn('actions', 'admin/team/actions')
            ->addColumn('date', function($query){
                return date('d.m.Y', strtotime($query->created_at));
            })

            ->addColumn('nameSurname', function($query){
                return "<a href = '" . route('fullNewsPage', ['news' => $query['alias']]) . "' target = '_blank'>" . $query['name'] . "</a>";
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
        return view('admin/team/form');

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
            'name' => 'required|unique:team',
            'position' => 'required',
            'education' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();
        $input['alias'] = Alias::generateAlias($input['name']);

        if(isset($input['image']) && !empty($input['image'])){
            $image = str_replace('data:image/png;base64,', '', $input['image']);
            $image = str_replace(' ', '+', $image);

            $input['image'] = uniqid() . '.png';
            $path = public_path() . '/images/team/' . $input['image'];

            File::put($path, base64_decode($image));
        }

        $person = new Team();
        $person->fill($input);
        $person->save();

        return response()->json([
            'message' => "Persoana a fost adăugata"
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
        return view('admin/team/form', Team::findOrFail($id));
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
            'name' => 'required|unique:team,name,'.$request['id'],
            'position' => 'required',
            'education' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        $input['alias'] = Alias::generateAlias($input['name']);

        if(isset($input['image']) && !empty($input['image'])){

            File::delete(public_path() . '/images/team/' . $input['old_image']);

            $image = str_replace('data:image/png;base64,', '', $input['image']);
            $image = str_replace(' ', '+', $image);

            $input['image'] = uniqid() . '.png';
            $path = public_path() . '/images/team/' . $input['image'];

            File::put($path, base64_decode($image));
        }else{
            $input['image'] = $input['old_image'];
        }

        $person = Team::findOrFail($id);
        $person->fill($input);
        $person->update();

        return response()->json([
            'message' => "Persoana au fost actualizata"
        ], 201);
    }

    public function delete($id){
        return view('admin.team.delete', Team::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Team::findOrFail($id);

        if(isset($person['image']) && !empty($person['image'])){
            File::delete(public_path() . '/images/team/' . $person['image']);
        }

        $person->delete();

        return response()->json([
            'message' => 'Persoana au fost ștearsa'
        ], 200);
    }
}
