<?php

namespace Modules\User\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserRequest;

class UserController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('user::dashboard.list');
    }

    public function create()
    {
        return view('user::dashboard.form');
    }

    public function store(UserRequest $request)
    {
        $avatar = $this->UploadFile($request, 'avatar', 'avatars', $request->username);

        $user = User::create(array_merge($request->all(), ['avatar' => $avatar]));
        $user->set_password($request->password);
        $user->set_role($request->level);
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'users.index');
    }

    public function show($id)
    {
        return view('user::show');
    }

    public function edit(User $user)
    {
        return view('user::dashboard.form', compact('user'));
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
