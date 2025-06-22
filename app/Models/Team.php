<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'bio',
        'linkedin_url',
        'is_active',
    ]; 
}
