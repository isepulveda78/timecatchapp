<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'project', 'billable', 'date', 'notes', 'total_hours', 'total_minutes'];

    public function path()
    {
        return '/projects/' . $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function getTotalHoursAttribute() 
    {
        if($this->tasks->count() > 0){
            return $this->tasks->reduce(function($total,$task) {
                if($task->worked_time > 0) {
                    return floor($total + $task->worked_time / 60);
                } else {
                    return $total;
                }
            },0);
        } else{ 
            return 0;
        }
    }

    public function getTotalMinutesAttribute() 
    {
        if($this->tasks->count() > 0){
            return $this->tasks->reduce(function($total,$task) {
                if($task->worked_time > 0) {
                    return floor($total + $task->worked_time % 60);
                } else {
                    return $total;
                }
            },0);
        } else{ 
            return 0;
        }
    }
}


