<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail; 
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Searchable;

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

    public function avatar($size = 45)
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=mm';
    }

    public function getAvatarAttribute()
    {
        return $this->avatar(25);
    }

    public function toSearchableArray()
    {
        $properties = $this->toArray();

        $properties['avatar'] = $this->avatar(25);
        
        return $properties;
    }

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

    public function messages()
    {
        return $this->hasMany(TaskMessage::class);
    }

    public function hasLikedMessage(TaskMessage $message)
    {
        return (bool) $message->likes->where('user_id', $this->id)->count();
    }

    
}
