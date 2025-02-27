<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'google_id',
        'password',
        'image',
        'status',
        'phone',
        'country',
        'city',
        'street',
        'email_verified_at'
    ];

    public function posts(){
        return $this->hasMany(Post::class, 'user_id');
    }
    /**
     * To change channel
     * 1- in User Model added function
     * 2- in app.js change in private method
     * 3- in channels.php in folder routes change her name
     */
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.'.$this->id;
    }
    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'=>'hashed'
    ];
}
