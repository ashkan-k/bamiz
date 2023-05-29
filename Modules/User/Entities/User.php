<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'username',
//        'block_status',
        'level',
        'phone',
        'avatar',
        'email_verified_at'
    ];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }

    public function isAdmin()
    {
        return $this->level == 'admin';
    }

    //

//    public function articles()
//    {
//        return $this->hasMany(Article::class);
//    }
//
//    public function centers()
//    {
//        return $this->hasMany(Center::class);
//    }
//
//    public function galleries()
//    {
//        return $this->hasMany(Gallery::class);
//    }
//
//    public function comments()
//    {
//        return $this->hasMany(Comment::class);
//    }
//
//    public function wish_lists()
//    {
//        return $this->hasMany(WishList::class);
//    }
//
//    public function reserves()
//    {
//        return $this->hasMany(Reserve::class);
//    }
//
//    public function tickets()
//    {
//        return $this->hasMany(Ticket::class);
//    }
//
//    public function answers()
//    {
//        return $this->hasMany(Answer::class);
//    }
//
//    public function payments()
//    {
//        return $this->hasMany(Payment::class);
//    }
}
