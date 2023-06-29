<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Category\Entities\Category;
use Modules\Gallery\Entities\Gallery;
use Modules\Place\Entities\Place;

class FrontController extends Controller
{
    private $place_relations = ['user', 'category', 'province', 'options'];

    public function index()
    {
        $popular_places = Place::withCount([
            'reserves as reserves_count' => function ($query) {
                $query->where('status', 1);
            },
        ])->with($this->place_relations)->orderByDesc('reserves_count')->limit(5)->get();

        $latest_places = Place::with('province')->latest()->limit(4)->get();
        $categories = Category::whereDoesntHave('children')->get();
        $latest_galleries = Gallery::with('place')->latest()->limit(20)->get();
        $latest_articles = Article::where('status', 'publish')->latest()->limit(4)->get();

        return view('front::index', compact('popular_places', 'categories', 'latest_articles', 'latest_galleries', 'latest_places'));
    }

//    public function mizbans($slug)
//    {
//        return view('Front.mizbans' , compact('slug'));
//    }
//
//    public function center_detail()
//    {
//        return view('Front.center_detail');
//    }
//
//    public function galleries()
//    {
//        return view('Front.galleries');
//    }
//
//    public function about_us()
//    {
//        return view('Front.about_us');
//    }
//
//    public function contact_us_show()
//    {
//        return view('Front.contact_us');
//    }
//
//    public function contact_us_submit(ContactUsRequest $request)
//    {
//        ContactUs::create($request->all());
//
//        session()->flash('contact_us_message' , 'کاربر عزیز پیام تماس شما با موفقیت ثبت شد.');
//        return redirect('/contact_us');
//    }
//    public function blog_detail()
//    {
//        return view('Front.blog_detail');
//    }
//
//    public function blogs_center()
//    {
//        return view('Front.blogs_center');
//    }
}
