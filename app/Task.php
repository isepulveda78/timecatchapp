<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =  [ 'name', 'user_id', 'clocked_in', 'clocked_out'];

    protected $casts = [
        'clocked_in' => 'H:i:s'
    ];


    public function path()
    {
        return '/tasks/' . $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
