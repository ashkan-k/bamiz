<?php

namespace Modules\Reserve\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Place\Entities\Table;

class ReserveType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'price',
    ];

    protected $search_fields = [
        'title',
        'price',
    ];

    protected static function newFactory()
    {
        return \Modules\Reserve\Database\factories\ReserveTypeFactory::new();
    }

    //

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
