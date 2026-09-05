<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        
        return TaskResource::collection(Task::all());
    }

    public function store(Request $request)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pendiente,en_progreso,completada',
            'user_id' => 'required|exists:users,id',
        ]);
        $task = Task::create($validated);
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        
        return new TaskResource($task);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|string|in:pendiente,en_progreso,completada',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $task->update($validated);
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        // TODO(sesion-04): borra la línea de abajo y descomenta el bloque completo.
        $task->delete();
        return response()->json(null, 204);
    }
}
