<?php

namespace Modules\Article\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class Article extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        "title" ,"slug" ,"text","status" ,
        "like_count" ,"view_count" ,"image" ,"user_id" ,
    ];

    protected $search_fields = [
        'title',
        'text',
        'user.first_name',
        'user.last_name',
        'user.username',
    ];

    public function get_image()
    {
        return $this->image ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    public function get_status(){
        if ($this->status == 'draft'){
            return 'پیش نویس';
        }
        elseif ($this->status == 'publish'){
            return 'انتشار';
        }
        return  'پایان انتشار';
    }

    public function get_status_class(){
        if ($this->status == 'draft'){
            return 'warning';
        }
        elseif ($this->status == 'publish'){
            return 'success';
        }
        return  'danger';
    }

    public function save(array $options = [])
    {
        if (!$this->user_id){
            $this->user_id = auth()->id();
        }
        $this->slug = Str::slug($this->name);
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

    public function comments()
    {
        return $this->morphMany('Modules\Comment\Entities\Comment' , 'commentable');
    }

    protected static function newFactory()
    {
        return \Modules\Article\Database\factories\ArticleFactory::new();
    }
}
