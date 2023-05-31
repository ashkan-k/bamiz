<?php

namespace Modules\User\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Searchable;

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

    protected $search_fields = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
    ];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }

    public function isAdmin()
    {
        return $this->level == 'admin';
    }

    public function fullname()
    {
        if ($this->frist_name && $this->last_name) {
            return $this->frist_name . ' ' . $this->last_name;
        }

        return $this->username;
    }

    public function set_password($new_password)
    {
        $this->update(['password' => Hash::make($new_password)]);
    }

    public function set_role($role)
    {
        $this->level = $role;
        $this->save();
    }

    public function get_avatar()
    {
        return $this->avatar ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    public function get_level(){
        if ($this->level == 'user'){
            return 'کاربر';
        }
        elseif ($this->level == 'staff'){
            return 'کارمند';
        }
        elseif ($this->level == 'admin'){
            return 'مدیر';
        }
        return  'مدیر رستوران';
    }

    public function get_level_class(){
        if ($this->level == 'user'){
            return 'info';
        }
        elseif ($this->level == 'staff'){
            return 'warning';
        }
        elseif ($this->level == 'admin'){
            return 'success';
        }
        return  'danger';
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
