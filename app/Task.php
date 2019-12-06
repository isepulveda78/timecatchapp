<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =  [ 'name', 'user_id', 'clocked_in', 'clocked_out'];

    protected $casts = [
        'clocked_in' => 'H:i:s'
    ];

    protected $appends = ['worked_time'];

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
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getWorkedTimeAttribute() {
        return Carbon::parse($this->clocked_out)->diffInMinutes($this->clocked_in);
    }

    public function getWorkedTimeReadableAttribute() {
        return Carbon::parse($this->clocked_out)->diffForHumans($this->clocked_in);
    }

}
