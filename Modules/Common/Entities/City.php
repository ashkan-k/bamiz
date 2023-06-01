<?php

namespace Modules\Common\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'province_id',
    ];

    protected $search_fields = [
        'title',
        'province.title',
    ];

    protected static function newFactory()
    {
        return \Modules\Common\Database\factories\CityFactory::new();
    }
}
