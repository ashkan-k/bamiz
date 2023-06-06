<?php

namespace Modules\Food\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Place;

class Food extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ["title", "description", "image", "place_id", "slug", "price"];

    protected $search_fields = [
        'title',
        'description',
        'place.name',
    ];

    protected $filter_fields = [
        'place_id',
    ];

    public function get_image()
    {
        return $this->image ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    protected static function newFactory()
    {
        return \Modules\Food\Database\factories\FoodFactory::new();
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
