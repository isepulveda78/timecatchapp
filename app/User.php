<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail; 

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'location', 'title', 'education', 'about', 'password', 'api_token', 'email_verified_at'];

    public function path()
    {
        return '/users/' . $this->id;
    }
    
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function accounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function assigned()
    {
        return $this->belongsToMany(Task::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getEmail()
    {
        return $this->email;
    }
    
}
