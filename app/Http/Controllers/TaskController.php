<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'data' => $tasks
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'completed' => 'boolean',
        ]);

        return Task::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'completed' => 'boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return $task;
    }


    public function destroy($id)
    {
        Task::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
