<?php

namespace Modules\Gallery\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Place;

class Gallery extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ "image", "place_id"];

    protected $search_fields = [
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
        return \Modules\Gallery\Database\factories\GalleryFactory::new();
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
