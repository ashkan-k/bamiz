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

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    protected static function newFactory()
    {
        return \Modules\Gallery\Database\factories\GalleryFactory::new();
    }
}
