<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clock extends Model
{
    protected $fillable = ['task_id', 'clocked_in', 'clocked_out'];
    
    protected $casts = [
        'clocked_in' => 'H:i:s'
    ];

    public function path()
    {
        return '/clock/' . $this->id;
    }

    protected $appends = ['worked_time'];
    
    public function getWorkedTimeAttribute() {
        return Carbon::parse($this->clocked_out)->diffInMinutes($this->clocked_in);
    }

    public function getWorkedTimeReadableAttribute() {
        return Carbon::parse($this->clocked_out)->diffForHumans($this->clocked_in);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
