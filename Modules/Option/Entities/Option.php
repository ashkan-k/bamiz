<?php

namespace Modules\Option\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        "title", "amount", "description", "image",
    ];

    protected $search_fields = [
        'title',
        'amount',
        'description',
    ];

    public function get_image()
    {
        return $this->image ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    protected static function newFactory()
    {
        return \Modules\Option\Database\factories\OptionFactory::new();
    }
}
