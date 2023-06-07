<?php

namespace Modules\Ticket\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class Ticket extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'ticket_category_id',
        'title',
        'text',
        'file',
        'status',
    ];

    protected $search_fields = [
        'title',
        'text',
        'user.first_name',
        'user.last_name',
        'user.username',
        'category.title',
    ];

    protected $filter_fields = [
        'user_id',
        'category_id',
        'status',
    ];

    public function get_status()
    {
        if ($this->status == 'waiting') {
            return 'در انتظار';
        } elseif ($this->status == 'answered') {
            return 'پاسخ داده شده';
        }
        return 'بسته';
    }

    public function get_status_class()
    {
        if ($this->status == 'waiting') {
            return 'warning';
        } elseif ($this->status == 'answered') {
            return 'success';
        }
        return 'danger';
    }

    public function get_file()
    {
        return $this->file ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    protected static function newFactory()
    {
        return \Modules\Ticket\Database\factories\TicketFactory::new();
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }

    public function answers()
    {
        return $this->hasMany(TicketAnswer::class);
    }
}
