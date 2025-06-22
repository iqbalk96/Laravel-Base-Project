<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'category_id',
        'is_published',
        'published_at',
    ]; 
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
