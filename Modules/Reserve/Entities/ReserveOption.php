<?php

namespace Modules\Reserve\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Option\Entities\Option;

class ReserveOption extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'option_id',
        'reserve_id',
    ];

    protected $search_fields = [
        'option.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Reserve\Database\factories\ReserveOptionFactory::new();
    }

    //

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function reserve()
    {
        return $this->belongsTo(Reserve::class);
    }
}
