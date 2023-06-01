<?php

namespace Modules\Place\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\User\Entities\User;

class Place extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'chairs_people_count',
        'viewCount',
        'cover',
        'user_id',
        'category_id',
        'province_id',
        'city_id',
    ];

    protected $search_fields = [
        'name',
        'slug',
        'description',
        'user.username',
        'user.first_name',
        'user.last_name',
        'category.title',
        'province.title',
        'city.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Place\Database\factories\PlaceFactory::new();
    }

    public function get_cover()
    {
        return $this->cover ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
