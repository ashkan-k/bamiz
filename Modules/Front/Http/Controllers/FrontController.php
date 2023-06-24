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
    private $place_relations = ['user', 'category', 'province'];

    public function index()
    {
        $places = Place::with(['options' => function ($query){
            return $query->whereIn('title' , ['فضای بازی' , 'اینترنت رایگان' , 'موسیقی زنده' , 'فضای سبز' , 'فضای vip'])->get(['title'])->toArray();
        }])->with($this->place_relations)->limit(5)->get();

        $latest_places = Place::query()->orderByDesc('created_at')->take(4)->get();
        $categories = Category::whereDoesntHave('children')->get();
        $latest_galleries = Gallery::latest()->take(20)->get();
        $latest_articles = Article::where('status' , 'publish')->latest()->take(4)->get();

        return view('front::index', compact('places', 'categories', 'latest_articles', 'latest_galleries', 'latest_places'));
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
//    public function centers()
//    {
//        return view('Front.centers');
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
//
//    public function blogs()
//    {
//        return view('Front.blogs');
//    }
//
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
