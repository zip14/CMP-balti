<?php

namespace App\Http\Controllers;

use App\News;
use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{
    public function homePage(){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'topNews' => News::orderby('viewed', 'desc')->take(3)->get(),
            'lastSpecialty' => Specialty::orderby('created_at', 'desc')->take(3)->get(),
        ];
        $data['active'] = 'home';

//        echo ('<pre>');
//        print_r($data);
//        echo ('</pre>');die;
        return view('home', $data);
    }

    public function newsPage(){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'news';
        return view('news', $data);
    }

    public function fullNewsPage($id){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->with('category')->take(4)->get(),
            'news' => News::findOrFail($id),
        ];

        $data['active'] = 'news';

        DB::table('news')->where('id', '=', $id)->increment('viewed', 1);

        return view('fullNews', $data);
    }

    public function gallaryPage(){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'gallary';
        return view('gallary', $data);
    }

    public function aboutPage(){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'about';
        return view('about', $data);
    }

    public function specialtyPage(){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'specialty' => Specialty::orderby('created_at', 'desc')->get(),
        ];

        $data['active'] = 'about';
        return view('specialty', $data);
    }

    public function fullSpecialtyPage($id){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'specialty' => Specialty::findOrFail($id),
        ];

        $data['active'] = 'about';

        return view('fullSpecialty', $data);
    }

    public function contactPage(){
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'contact';
        return view('contact', $data);
    }

}
