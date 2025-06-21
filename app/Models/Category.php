<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'is_active',
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
