<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'client',
        'year',
        'is_featured',
        'is_active',
    ];
}
