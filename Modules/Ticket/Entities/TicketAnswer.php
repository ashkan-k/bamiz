<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class TicketAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'text',
        'file',
    ];

    protected $search_fields = [
        'text',
        'user.first_name',
        'user.last_name',
        'user.username',
        'ticket.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Ticket\Database\factories\TicketAnswerFactory::new();
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
