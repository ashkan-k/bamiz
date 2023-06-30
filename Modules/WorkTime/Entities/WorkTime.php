<?php

namespace Modules\WorkTime\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Place;

class WorkTime extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ "week_days" , "start_time" ,"end_time" ,"place_id" ];

    protected $casts= [
        'week_days' => 'array'
    ];

    protected $search_fields  = [
        'week_days',
        'start_time',
        'end_time',
        'place.name',
    ];

    protected static function newFactory()
    {
        return \Modules\WorkTime\Database\factories\WorkTimeFactory::new();
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
