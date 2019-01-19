<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $input = $request->all();
        $objData = new \stdClass();
        $objData->name = $input['name'];
        $objData->email = $input['email'];
        $objData->message = $input['message'];


        Mail::to("zip14.05.1996@gmail.com")->send(new ContactEmail($objData));

        return response()->json([
            'message' => "E-mailul a fost trimis"
        ], 201);

    }
}
