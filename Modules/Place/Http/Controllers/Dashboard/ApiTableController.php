<?php

namespace Modules\Place\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Place;
use Modules\Reserve\Entities\ReserveType;

class ApiTableController extends Controller
{
    use Responses;

    public function list(Place $place, $reserve_type)
    {
        $tables = $place->tables()->where('reserve_type_id', $reserve_type)->get();
        return $this->SuccessResponse($tables);
    }
}
