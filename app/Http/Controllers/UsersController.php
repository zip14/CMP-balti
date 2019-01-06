<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('event.index');
        }
        return view('admin.users.login');
    }

    public function authenticate(Request $request)
    {

//        print_r($request->all());
        $remember = $request->input('remember');
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password], $remember)) {
            return response()->json([
                'message' => ""
            ], 201);
        }

        return response()->json([
            'message' => "Nume de utilizator sau parola incorectă"
        ], 422);
    }

    //return logout form
    public function logoutForm(){
        return view('admin.users.logout');
    }

    //logout action
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/users/index');
    }


    public function selectUsers()
    {
        $query = User::select('id', 'name', 'surname', 'type', 'image');

        return datatables($query)
            ->order(function ($query) {
                $columns = array(
                    1 => 'name',
                    2 => 'type',
                );

                $dir = request()->order[0]['dir'];
                $col =  $columns[intval(request()->order[0]['column'])];

                $query->orderBy($col, $dir);
            })
            ->rawColumns(['actions', 'nameSurname', 'image', 'type'])

            ->addColumn('image', 'admin/users/image')
            ->addColumn('actions', 'admin/users/actions')
            ->addColumn('nameSurname', function($query){
                return $query->name . ' ' . $query->surname;
            })

            ->addColumn('type', function($query){
                if($query->type == 'admin'){
                    return '<small class="label bg-blue">'. $query->type .'</small>';
                }else{
                    return '<small class="label bg-green">'. $query->type .'</small>';
                }
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
        return view('admin/users/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'login' => 'required|unique:users',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if(isset($input['image']) && !empty($input['image'])){
            $image = str_replace('data:image/png;base64,', '', $input['image']);
            $image = str_replace(' ', '+', $image);

            $input['image'] = uniqid() . '.png';
            $path = public_path() . '/images/users/' . $input['image'];

            File::put($path, base64_decode($image));
        }

        if(isset($input['type']) && $input['type'] == '1'){
            $input['type'] = 'admin';
        }else{
            $input['type'] = 'user';
        }

        $user = new User();
        $user->fill($input);
        $user->save();

        return response()->json([
            'message' => "Utilizator a fost adăugata"
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
        return view('admin/users/form', User::findOrFail($id));
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
        $input = $request->all();

        $this->validate($request, [
            'login' => 'required|unique:users,login,'.$request['id'],
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users,email,'.$request['id'],
        ]);

        if(isset($input['image']) && !empty($input['image'])){

            if(isset($input['image']) && !empty($input['image'])){
                File::delete(public_path() . '/images/users/' . $input['old_image']);
            }

            $image = str_replace('data:image/png;base64,', '', $input['image']);
            $image = str_replace(' ', '+', $image);

            $input['image'] = uniqid() . '.png';
            $path = public_path() . '/images/users/' . $input['image'];

            File::put($path, base64_decode($image));
        }

        $user = User::findOrFail($id);
        $user->fill($input);
        $user->update();

        return response()->json([
            'message' => "Persoana au fost actualizata"
        ], 201);

    }

    /**
     * Display change password form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password($id)
    {
        return view('admin.users.formChangePassword', User::findOrFail($id));
    }

    /**
     * Change user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        if($request->ajax()){
            $input = $request->all();

            if(Auth::user()->type == 'admin'){
                $this->validate($request, [
                    'password' => 'required',
                ]);
            }else{
                $this->validate($request, [
                    'password' => 'required',
                    'old_password' => 'required',
                    'confirm_password' => 'required',
                ]);

                if($input['password'] != $input['confirm_password']){
                    return response()->json([
                        'message' => "Parolele nu sunt identice"
                    ], 422);
                }

                $user = User::findOrFail(Auth::user()->id);
                if (!Hash::check($input['old_password'], $user['password'])){
                    return response()->json([
                        'message' => "Parolă veche introdusă incorect"
                    ], 422);
                }
            }

            $user = User::findOrFail($id);
            $user->fill($input);
            $user->update();

            if(Auth::user()->type != 'admin'){
                return response()->json([
                    'redirect' => "true"
                ], 201);
            }

            return response()->json([
                'message' => "Parola a fost modificată cu succes"
            ], 201);
        }
    }

    public function profile(){
        return view('admin.users.profile', User::findOrFail(Auth::user()->id));
    }

    public function delete($id){
        if(Auth::user()->type == 'admin'){
            return view('admin.users.delete', User::findOrFail($id));
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->type == 'admin'){
            $user = User::findOrFail($id);

            if(isset($user['image']) && !empty($user['image'])){
                File::delete(public_path() . '/images/users/' . $user['image']);
            }

            $user->delete();

            return response()->json([
                'message' => 'Persoana a fost ștearsă'
            ], 200);
        }
        abort(404);
    }
}
