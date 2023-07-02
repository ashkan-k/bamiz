<?php

namespace Modules\WishList\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Place;

class ApiWishListController extends Controller
{
    use Responses;

    public function add_and_remove(Place $place)
    {
        if (\request('type') == 'add') {
            auth()->user()->wish_lists()->create([
                'wish_listable_id' => $place->id,
                'wish_listable_type' => get_class($place),
            ]);
        } else {
            auth()->user()->wish_lists()
                ->where('wish_listable_id', $place->id)
                ->where('wish_listable_type', get_class($place))
                ->delete();
        }
        return $this->SuccessResponse('عملیات با موفقیت انجام شد.');
    }
}
