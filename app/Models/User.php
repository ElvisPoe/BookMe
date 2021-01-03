<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userData(){
        return $this->hasOne(ProfileData::class);
    }

    public function ownedBy(User $user){
        return $user->id === $this->user_id;
    }

    public function isVenue(){
        return auth()->user()->role != '1';
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
