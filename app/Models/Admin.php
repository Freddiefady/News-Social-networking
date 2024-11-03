<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Authorizations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // public function posts(){
    //     return $this->hasMany(Post::class, 'category_id');
    // }
    public function posts(){
        return $this->hasMany(Post::class, 'admin_id');
    }
    public function role()
    {
        return $this->belongsTo(Authorizations::class, 'role_id');
    }
    public function hasAccess($config_permission)
    {
        $authorizations = $this->role;

        if(!$authorizations)
        {
            return false;
        }

        foreach($authorizations->permissions as $permission)
        {
            if($config_permission == $permission ?? false)
            {
                return true;
            }
        }
    }
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'admin.'.$this->id;
    }

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'status',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'=>'hashed'
    ];
}
