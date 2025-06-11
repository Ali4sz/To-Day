<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $section = 'today')
    {
        // $section can be used to determine which view is initially active if navigating directly
        return view('task', ['initialSection' => $section]); // Assuming your blade file is tasks.blade.php
    }

    // Method to fetch all tasks data for AJAX
    public function getAllTasksData()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get()->map(function ($task) {
            return [
                'id' => $task->id,
                'task_name' => $task->task_name,
                'display_due_string' => $task->display_due_date_string, // Using accessor
                'priority' => $task->priority,
                'is_completed' => $task->is_completed,
            ];
        });
        return response()->json($tasks);
    }

    public function getTodaysTasksData()
    {
        $tasks = Task::whereDate('due_date', Carbon::today())
            ->orWhere('is_completed', true) // Usually, you only want incomplete tasks for today
            ->orderBy('priority', 'desc')  // Example ordering
            ->orderBy('due_date', 'asc')
            ->get()
            ->map(function ($task) {
                return [
                    'id' => $task->id,
                    'task_name' => $task->task_name,
                    // 'due_date_formatted' => $task->formatted_due_date,
                    'display_due_string' => $task->display_due_date_string,
                    'priority' => $task->priority,
                    'priority_label' => $task->priority_label,
                    'is_completed' => $task->is_completed,
                ];
            });
        return response()->json($tasks);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'taskName' => 'required|string|max:255',
            'dueDate' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        try {
            $task = new Task();
            $task->task_name = $request->input('taskName'); // Match your DB column, e.g., 'name' or 'task_name'
            $task->due_date = $request->input('dueDate') ? Carbon::parse($request->input('dueDate')) : null;
            $task->priority = $request->input('priority');
            $task->user_id = Auth::id();
            // Determine if the task is for today
            // if ($isToday = $task->due_date && Carbon::parse($task->due_date)->isToday()) {
            //     $task->is_today = true;
            // } else {
            //     $task->is_today = false;
            // }
            // $task->is_completed = false; // Default for new tasks
            $task->save();




            return response()->json([
                'message' => 'Task added successfully!',
                'task' => $task
            ], 201); // Created
        } catch (\Exception $e) {
            // Log the error for server-side debugging
            \Log::error('Error saving task: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while saving the task. Please try again.'
            ], 500); // Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // $task = Task::findOrFail()
        $validated = $request->validate([
            'is_completed' => 'required|boolean',
        ]);

        try {
            $task->is_completed = $validated['is_completed'];
            $task->save();

            return response()->json([
                'message' => 'Task updated successfully',
                'task' => $task,
            ], 200);
        } catch (Exception $e) {
            // Log the error for server-side debugging
            \Log::error('Error updating task ' . ($task->id ?? 'unknown') . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while updating the task. Please try again.'
            ], 500); // Internal Server Error
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
        ], 200);
    }
}
