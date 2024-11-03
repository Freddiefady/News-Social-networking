<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'favicon',
        'logo',
        'email',
        'password',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'phone',
        'country',
        'city',
        'street',
    ];
}
