<?php

namespace App\Http\Controllers;

use App\Clock;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Http\Requests\ClockRequest;
use Symfony\Component\HttpFoundation\Response;

class ClockController extends Controller
{

    public function index()
    {
        $clock = request()->task()->clock();

        return response()->json([
            'data' => $clock
        ],200);
    }

    public function store(ClockRequest $request)
    {
        $clock = Clock::create([
            'task_id' => $request->task_id,
            'clocked_in' => Carbon::now(),
        ]);
   
        return response()->json([
            'data' => $clock
        ],201);    
    }

    public function show(Clock $clock)
    {
        return response()->json([
            'data' => $clock
        ],200);
    }


    public function update(ClockRequest $request, Clock $clock)
    {
        $clock->update([
            'task_id' => $request->task_id,
            'clocked_out' => Carbon::now()
        ]);

        return response()->json([
            'data' => $clock
        ],201);       
    }

    public function destroy(Clock $clock)
    {
        $clock->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

}
