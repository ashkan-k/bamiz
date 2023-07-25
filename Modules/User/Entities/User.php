<?php

namespace Modules\User\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Modules\Article\Entities\Article;
use Modules\Auth\Entities\ActivationCode;
use Modules\Comment\Entities\Comment;
use Modules\Payment\Entities\Payment;
use Modules\Place\Entities\Place;
use Modules\Reserve\Entities\Reserve;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Entities\TicketAnswer;
use Modules\WishList\Entities\WishList;

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
        'phone_verified_at'
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

    public function is_active()
    {
        return $this->phone_verified_at ? 1 : 0;
    }

    public function is_admin()
    {
        return $this->level == 'admin';
    }

    public function fullname()
    {
        if ($this->first_name && $this->last_name) {
            return $this->frist_name . ' ' . $this->last_name;
        }

        return $this->username;
    }

    public function set_password($new_password)
    {
        $this->password = Hash::make($new_password);
        $this->save();
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

    public function get_level()
    {
        if ($this->level == 'user') {
            return 'کاربر';
        } elseif ($this->level == 'staff') {
            return 'کارمند';
        } elseif ($this->level == 'admin') {
            return 'مدیر';
        }
        return 'مدیر رستوران';
    }

    public function get_level_class()
    {
        if ($this->level == 'user') {
            return 'info';
        } elseif ($this->level == 'staff') {
            return 'warning';
        } elseif ($this->level == 'admin') {
            return 'success';
        }
        return 'danger';
    }

    public function is_staff()
    {
        return in_array($this->level, ['staff', 'admin']);
    }

    //

    public function activation_codes()
    {
        return $this->hasMany(ActivationCode::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function wish_lists()
    {
        return $this->hasMany(WishList::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticket_answeres()
    {
        return $this->hasMany(TicketAnswer::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
