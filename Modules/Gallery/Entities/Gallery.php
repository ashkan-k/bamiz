<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Place;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [ "image", "place_id"];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    protected static function newFactory()
    {
        return \Modules\Gallery\Database\factories\GalleryFactory::new();
    }
}
