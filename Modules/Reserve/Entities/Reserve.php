<?php

namespace Modules\Reserve\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Option\Entities\Option;
use Modules\Payment\Entities\Payment;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class Reserve extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        "date",
        "start_time",
        "end_time",
        "guest_count",
        "amount",
        "status",
        "type",
        "user_id",
        "place_id",
    ];

    protected $search_fields = [
        "guest_count",
        "amount",
        "user.first_name",
        "user.last_name",
        "user.username",
        "place.name",
        "place.description",
    ];

    protected static function newFactory()
    {
        return \Modules\Reserve\Database\factories\ReserveFactory::new();
    }

    //

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
