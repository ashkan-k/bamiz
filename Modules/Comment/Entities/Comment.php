<?php

namespace Modules\Comment\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Article\Entities\Article;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class Comment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ "title", "body", "like_count", "center_id", "user_id" , "status" , "commentable_type" , "commentable_id"];

    protected $search_fields = [
        'title',
        'body',
        'user.first_name',
        'user.last_name',
        'user.username',
    ];

    public function get_status(){
        if ($this->status == 'pending'){
            return 'در انتظار';
        }
        elseif ($this->status == 'approved'){
            return 'تایید شده';
        }
        return  'رد شده';
    }

    public function get_status_class(){
        if ($this->status == 'pending'){
            return 'warning';
        }
        elseif ($this->status == 'approved'){
            return 'success';
        }
        return  'danger';
    }

    protected static function newFactory()
    {
        return \Modules\Comment\Database\factories\CommentFactory::new();
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Polymorphic
    public function commentable()
    {
        return $this->morphTo();
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'commentable_id')
            ->where('commentable_type' , Place::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'commentable_id')
            ->where('commentable_type' , Article::class);
    }
}
