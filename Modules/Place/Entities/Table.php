<?php

namespace Modules\Place\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Reserve\Entities\ReserveType;

class Table extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'price',
        'reserve_type_id',
        'place_id',
    ];

    protected $search_fields = [
        'title',
        'price',
        'place.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Place\Database\factories\TableFactory::new();
    }

    //

    public function reserve_type()
    {
        return $this->belongsTo(ReserveType::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
