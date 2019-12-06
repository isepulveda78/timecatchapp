<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Task;
use App\Project;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class ProjectController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Project::class);

        return ProjectResource::collection(request()->user()->projects()->paginate(2));
    }

    public function store(Project $project, Request $request)
    {
        $this->authorize('create', Project::class);
       
        $project = request()->user()->projects()->create($this->validateData());
 
        $this->syncTasksandProjects($project,$request);

        return (new ProjectResource($project))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return new ProjectResource($project);
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateData());

        $this->syncTasksandProjects($project,$request);

        return (New ProjectResource($project))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

    public function userTasks()
    {
        $tasks = request()->user()->tasks()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'data' => $tasks
        ], 200);
    }

    private function syncTasksandProjects(Project $project, Request $request)
    {
        $tasks = $this->getTasksDataFromRequest($request);
        $tasks_array = [];
        foreach(array_collapse($tasks) as $task_data){
            array_push($tasks_array, $task_data['id']);
        }
        $project->tasks()->sync($tasks_array);
    }

    private function getDataFromRequest(Request $request)
    {
        $data = $request->only([
            'project',
            'notes',
            'billable',
            'date'
        ]);

        return $data;
    }

    private function getTasksDataFromRequest(Request $request)
    {
        $data = $request->only([
            'tasks'
        ]);

        return $data;
    }


    public function validateData()
    {
        return request()->validate([
            'project' => 'required',
            'billable' => 'nullable',
            'date' => 'nullable',
            'notes' => 'nullable',
            'total_hours' => 'nullable',
            'total_minutes' => 'nullable'
        ]);
    }

    public function getProjects()
    {
        $projectCount = request()->user()->projects()->count();

        return response()->json([
            'data' => $projectCount
        ], 200);
    }

    public function calculateTime(Project $project)
    {
        $this->authorize('update', $project);

        $project->update([
            'total_hours' => $project->getTotalHoursAttribute(),
            'total_minutes' => $project->getTotalMinutesAttribute() 
        ]);
        
        return (new ProjectResource($project))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }


}
