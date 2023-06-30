<?php

namespace Modules\ContactUs\Entities;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title' , 'text' , 'first_name' , 'last_name' , 'email'];

    protected $search_fields  = [
        'title',
        'text',
        'first_name',
        'last_name',
        'email',
    ];

    protected static function newFactory()
    {
        return \Modules\ContactUs\Database\factories\ContactUsFactory::new();
    }
}
