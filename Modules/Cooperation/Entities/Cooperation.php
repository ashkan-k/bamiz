<?php

namespace Modules\Cooperation\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cooperation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ "first_name",  "last_name",  "phone",  "address",  "description",  "file" ];

    protected $search_fields  = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'description',
    ];

    public function get_file()
    {
        return $this->file ?? 'https://www.hardiagedcare.com.au/wp-content/uploads/2019/02/default-avatar-profile-icon-vector-18942381.jpg';
    }

    protected static function newFactory()
    {
        return \Modules\Cooperation\Database\factories\CooperationFactory::new();
    }
}
