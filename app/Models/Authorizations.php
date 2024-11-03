<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Authorizations extends Model
{
    use HasFactory;
    protected $fillable = ['role', 'permissions'];

    public function getPermissionsAttribute($permissions)
    {
    return json_decode($permissions);
    }
    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id');
    }
}
