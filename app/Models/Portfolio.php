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
        'category_id',
        'client',
        'year',
        'is_featured',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
