<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\TaskMessage;
use Illuminate\Http\Request;

class TaskMessageController extends Controller
{
  
    public function postMessage(TaskMessage $taskMessage)
    {
        $taskMessage = Auth::user()->messages()->create($this->validateData());

        return response()->json([
            'data' => $taskMessage
        ], 200);
    }

    public function getLike($taskMessageid)
    {
        $taskMessage = TaskMessage::find($taskMessageid);

        if(!$taskMessage)
        {
            return redirect()->route('home');
        }

        if(!Auth::user()->friends($taskMessage->user))
        {
            return redirect()->route('home');
        }
        if(Auth::user()->hasLikedMessage($taskMessage))
        {
            return redirect()->back();
        }

        $like = $taskMessage->likes()->create([
            'user_id' => auth()->user()->id
        ]);
        Auth::user()->likes()->save($like);

        return response()->json([
            'data' => $like
        ], 200);
    }

    public function validateData()
    {
        return request()->validate([
            'user_id' => 'required',
            'task_id' => 'required',
            'body' => 'required'
        ]);
    }

}
