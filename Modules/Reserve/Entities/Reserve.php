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
//        "end_time",
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

    public function get_type(){
        if ($this->type == 'table_for_food'){
            return 'رزرو میز برای سرو';
        }
        elseif ($this->type == 'work_appointment'){
            return 'رزرو میز بدون سفارش (قرارکاری)';
        }
        elseif ($this->type == 'table_for_birth_day_with_food'){
            return 'رزرو میز برای تولد با سرو';
        }
        return 'رزرو میز برای تولد بدون سرو';
    }

    public function get_type_class(){
        if ($this->type == 'draft'){
            return 'warning';
        }
        elseif ($this->type == 'publish'){
            return 'success';
        }
        return  'danger';
    }

    public function get_option_names()
    {
        return implode(', ', $this->options()->get()->pluck('title')->toArray());
    }

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
        return $this->belongsToMany(Option::class, 'reserve_options');
    }

    public function options_pluck_ids()
    {
        return $this->options()->get()->pluck('id')->toArray();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
