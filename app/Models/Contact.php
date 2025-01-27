<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'email', 'phone', 'title', 'body', 'ip_address', '_token'];
    protected $fillable = [
        'name', 'email', 'phone', 'title', 'body', 'ip_address'
    ]; // All fields are mass assignable
}
