<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMessage extends Model
{
    protected $fillable = ['body', 'user_id', 'task_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task_message()
    {
        return $this->belongsTo(Task::class);
    }

    public function reply()
    {
        return $this->hasMany(TaskMessage::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class);
    }
}
