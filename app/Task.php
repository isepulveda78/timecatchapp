<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Notifiable;
    protected $fillable =  [ 'name', 'user_id', 'clocked_in', 'clocked_out', 'total_time'];

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

    public function clocks()
    {
        return  $this->hasMany(Clock::class);
    }

    public function getWorkedTimeAttribute()
    {
        if($this->clocks->count() > 0){
            return $this->clocks->reduce(function($total,$clock) {
                if($clock->worked_time > 0) {
                    return $total + $clock->worked_time;
                } else {
                    return $total;
                }
            },0);
        } else{ 
            return 0;
        }
    }

}
