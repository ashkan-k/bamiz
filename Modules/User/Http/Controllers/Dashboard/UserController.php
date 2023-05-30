<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('user::dashboard.list');
    }

    public function create()
    {
        return view('user::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('user::show');
    }

    public function edit($id)
    {
        return view('user::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
