<?php

namespace Modules\WishList\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Food\Entities\Food;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class WishList extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ "user_id" , "wish_listable_id" , "wish_listable_type" ];

    protected $search_fields= [
        'user.first_name',
        'user.last_name',
        'user.username',
    ];

    protected static function newFactory()
    {
        return \Modules\WishList\Database\factories\WishListFactory::new();
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Polymorphic
    public function wish_listable()
    {
        return $this->morphTo();
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'wish_listable_id')
            ->where('wish_listable_type' , Place::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'wish_listable_id')
            ->where('wish_listable_type' , Food::class);
    }

}
