<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebProfile extends Model
{
    protected $table = 'web_profiles';

    protected $fillable = [
        'title',
        'description',
        'logo',
        'favicon',
    ];
}
