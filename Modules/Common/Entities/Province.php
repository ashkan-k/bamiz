<?php

namespace Modules\Common\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title'
    ];

    protected $search_fields = [
        'title',
    ];

    protected static function newFactory()
    {
        return \Modules\Common\Database\factories\ProvinceFactory::new();
    }
}
