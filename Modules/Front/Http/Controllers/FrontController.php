<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FrontController extends Controller
{
    public function index()
    {
        return view('front::index');
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
