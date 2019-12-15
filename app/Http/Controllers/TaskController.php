<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Notifications\AddUserToTask;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    public function allTasks()
    {
        return view('task');
    }
  
    public function index()
    {
        $this->authorize('viewAny', Task::class);

        return TaskResource::collection(request()->user()->tasks()->paginate(5));
    }

    public function store(Task $task, Request $request)
    {
       $this->authorize('create', Task::class);
       
       $task = request()->user()->tasks()->create($this->validateData());

       $this->syncFriendsFromRequest($task,$request);

       return (new TaskResource($task))
       ->response()
       ->setStatusCode(Response::HTTP_CREATED);
    }


    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return new TaskResource($task);
    }

   
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $task->update($this->validateData());

        $this->syncFriendsFromRequest($task,$request);

       

        return (new TaskResource($task))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

    public function validateData()
    {
        return request()->validate([
            'name' => 'required'
        ]);
    }

    public function clockin(Task $task)
    {

        $task->update([
            'clocked_in' => Carbon::now()
        ]);
        
        return (new TaskResource($task))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }

    public function clockout(Task $task)
    {
        
        $task->update([
            'clocked_out' => Carbon::now()
        ]);

        return (new TaskResource($task))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }

    public function friends()
    {
        return response()->json([
            'data' => User::all()
        ],200);
    }

    public function tasksWithFriends()
    {
        return TaskResource::collection(auth()->user()->assigned()->paginate(5));
    }

    public function taskWithFriends(Task $task)
    {
        return response()->json([
            'data' => $task
        ], 200);
    }

    private function syncFriendsFromRequest(Task $task, Request $request)
    {   $friends = $this->getFriendsDataFromRequest($request);
        $friends_array = [];
        foreach(array_collapse($friends) as $friend_data) {
            array_push($friends_array,$friend_data['id']);
        }
        $task->friends()->sync($friends_array);
    }

    private function getDataFromRequest(Request $request)
    {
        $data = $request->only([
            'name',
            'user_id',
            'clocked_in',
            'clocked_out',
        ]);
        return $data;
    }

    private function getFriendsDataFromRequest(Request $request)
    {
        $data = $request->only([
            'friends'
        ]);

        return $data;
    }

    public function getTasks()
    {
        $taskCount = request()->user()->tasks()->count();

        return response()->json([
            'data' => $taskCount
        ], 200);
    }
}
