<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'provider_name', 'provider_id', 'api_token'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
