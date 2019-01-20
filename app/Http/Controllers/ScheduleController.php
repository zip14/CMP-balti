<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ScheduleController extends Controller
{

    //return schedule form
    public function form()
    {
        return view('admin/schedule/form', Schedule::findOrFail('1'));
    }

    //update schedule link
    public function save(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
        ]);

        $input = $request->all();

        $schedul = Schedule::findOrFail('1');
        $schedul->fill($input);
        $schedul->update();

        return response()->json([
            'message' => "Orarul a fost actualizat"
        ], 201);
    }
}
