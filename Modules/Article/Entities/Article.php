<?php

namespace Modules\Article\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "title" ,"slug" ,"text","status" ,
        "like_count" ,"view_count" ,"image" ,"user_id" ,
        "place_id"
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment' , 'commentable');
    }

    protected static function newFactory()
    {
        return \Modules\Article\Database\factories\ArticleFactory::new();
    }
}
