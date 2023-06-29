<?php

namespace Modules\Setting\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['key', 'value'];

    protected $search_fields  = [
        'key',
        'value',
    ];

    public static function getPriceFromSettings()
    {
        $setting =  Setting::firstOrCreate(['key' => 'price'] , ['value' => 1000]);
        return $setting->value;
    }

    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\SettingFactory::new();
    }
}
