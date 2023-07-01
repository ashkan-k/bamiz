<?php

namespace Modules\Place\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Comment;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Gallery\Entities\Gallery;
use Modules\Option\Entities\Option;
use Modules\Reserve\Entities\Reserve;
use Modules\User\Entities\User;
use Modules\WishList\Entities\WishList;
use Modules\WorkTime\Entities\WorkTime;

class Place extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'tour_link',
        'chairs_people_count',
        'viewCount',
        'cover',
        'user_id',
        'category_id',
        'province_id',
        'city_id',
        'address_lat',
        'address_long',
        'type',
    ];

    protected $casts = [
        'cover' => 'array'
    ];

    protected $search_fields = [
        'name',
        'slug',
        'description',
        'tour_link',
        'address_lat',
        'address_long',
        'user.username',
        'user.first_name',
        'user.last_name',
        'category.title',
        'province.title',
        'city.title',
    ];

    protected $filter_fields = [
        'type',
        'category_id',
        'province_id',
        'city_id',
    ];

    protected static function newFactory()
    {
        return \Modules\Place\Database\factories\PlaceFactory::new();
    }

    public function get_type(){
        if ($this->type == 'restaurant'){
            return 'رستوران';
        }
        elseif ($this->type == 'cafe'){
            return 'کافه';
        }
        return  'هتل';
    }

    public function get_cover($size)
    {
        return $this->cover ? $this->cover['images'][$size] : 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    public static function GetTypes()
    {
        return [
            ['id' => 'restaurant', 'name' => 'رستوران'],
            ['id' => 'cafe', 'name' => 'کافه'],
            ['id' => 'hotel', 'name' => 'هتل'],
        ];
    }

    public function save(array $options = [])
    {
        $this->slug = Slugify($this->name);

        try {
            $saved =  parent::save($options);
        }catch (\Exception $exception){
            $this->slug = Str::random(20);
            $saved =  parent::save($options);
        }
        return $saved;
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

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_places');
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }

    public function wish_lists()
    {
        return $this->morphMany(WishList::class , 'wish_listable');
    }

    public function work_time()
    {
        return $this->hasOne(WorkTime::class);
    }
}
