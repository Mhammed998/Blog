<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use  Notifiable;


    protected $fillable = [
        'full_name', 'email', 'password','type',
        'status','avatar','mobile','description',
        'last_login'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function  getUserType(){
        return $this->type;
    }


    // relationships here :

    public function posts(){
        return $this->hasMany(Post::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }






}
