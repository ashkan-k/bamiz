<?php

namespace Modules\Option\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Place;

class OptionPlace extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        "place_id", "option_id"
    ];

    protected $search_fields = [
        'place_id.title',
        'option_id.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Option\Database\factories\OptionPlaceFactory::new();
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
