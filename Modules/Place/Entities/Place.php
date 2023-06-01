<?php

namespace Modules\Place\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\User\Entities\User;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'chairs_people_count',
        'viewCount',
        'cover',
        'user_id',
        'province_id',
        'city_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Place\Database\factories\PlaceFactory::new();
    }

    public function get_image()
    {
        return $this->image ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
