<?php

namespace Modules\Place\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelRoom extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'description',
        'price',
        'place_id',
    ];

    protected $search_fields = [
        'title',
        'description',
        'price',
        'place.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Place\Database\factories\HotelRoomFactory::new();
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
