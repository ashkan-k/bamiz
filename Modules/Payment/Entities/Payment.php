<?php

namespace Modules\Payment\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Reserve\Entities\Reserve;
use Modules\User\Entities\User;

class Payment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'reserve_id',
        'amount',
        'refID',
        'authority',
        'ip',
        'status',
    ];

    protected $search_fields = [
        'user.first_name',
        'user.last_name',
        'user.username',
        'amount',
        'refID',
        'authority',
    ];

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\PaymentFactory::new();
    }

    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reserve()
    {
        return $this->belongsTo(Reserve::class);
    }
}
