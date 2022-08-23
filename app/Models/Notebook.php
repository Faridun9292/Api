<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'initials',
        'company',
        'phone',
        'email',
        'birthday',
        'photo'
    ];

    protected $dates = ['birthday'];
}
