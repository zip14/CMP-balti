<?php

namespace App\Http\Controllers;

use App\Comments;
use App\News;
use App\NewsCategory;
use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{
    public function homePage()
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'topNews' => News::orderby('viewed', 'desc')->take(3)->get(),
            'lastSpecialty' => Specialty::orderby('created_at', 'desc')->take(3)->get(),
        ];
        $data['active'] = 'home';

        return view('home', $data);
    }

    public function newsPage()
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'news' => News::orderby('created_at', 'asc')->paginate(9),
            'newsCategory' => NewsCategory::all(),
            'activeCategory' => 'all'
        ];

        $data['active'] = 'news';
        $data['selctedCategory'] = 'all';

        return view('news', $data);
    }

    public function categoryNewsPage($alias)
    {

        $selctedCategory = NewsCategory::where('alias', $alias)->first();

        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'news' =>  News::where('id_category', '=', $selctedCategory['id'])->paginate(9),
            'newsCategory' => NewsCategory::all(),
            'activeCategory' => 'all'
        ];

        $data['active'] = 'news';
        $data['selctedCategory'] = $alias;

        return view('news', $data);
    }

    public function fullNewsPage($alias)
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->with('category')->take(4)->get(),
            'news' => News::where('alias', $alias)->first(),
        ];

        $data['newsComments'] = Comments::orderby('created_at', 'desc')->where('id_news', $data['news']['id'])->get();
        $data['commentsCount'] = Comments::where('id_news', $data['news']['id'])->count();

        $data['active'] = 'news';

        DB::table('news')->where('alias', '=', $alias)->increment('viewed', 1);

        return view('fullNews', $data);
    }

    public function gallaryPage()
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'gallary';
        return view('gallary', $data);
    }

    public function aboutPage()
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'about';
        return view('about', $data);
    }

    public function specialtyPage()
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'specialty' => Specialty::orderby('created_at', 'desc')->get(),
        ];

        $data['active'] = 'about';
        return view('specialty', $data);
    }

    public function fullSpecialtyPage($alias)
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
            'specialty' => Specialty::where('alias', $alias)->first(),
        ];

        $data['active'] = 'about';

        return view('fullSpecialty', $data);
    }

    public function contactPage()
    {
        $data = [
            'lastNews' => News::orderby('created_at', 'desc')->take(4)->get(),
        ];

        $data['active'] = 'contact';
        return view('contact', $data);
    }

}
