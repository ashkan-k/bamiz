<?php

namespace Modules\Food\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
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

    public function save(array $options = [])
    {
        $this->slug = Str::slug($this->title);
        try {
            $saved =  parent::save($options);
        }catch (\Exception $exception){
            $this->slug = Str::random(20);
            $saved =  parent::save($options);
        }
        return $saved;
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
