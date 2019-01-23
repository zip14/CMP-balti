<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ScheduleController extends Controller
{

    /**
     * Show the form for editing the specified resource where id = 1.
     *
     * @return view
     */
    public function form()
    {
        return view('admin/schedule/form', Schedule::findOrFail('1'));
    }

    /**
     * Update the specified resource in storage where id = 1.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
