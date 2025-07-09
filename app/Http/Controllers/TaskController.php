<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingTasks = Task::where('status', 'pending')
                            ->whereDate('due_date', '>=', Carbon::today())
                            ->orderBy('due_date', 'asc')
                            ->orderBy('title', 'asc')
                            ->paginate(10);
        return view('dashboard.tasks', compact('pendingTasks'));
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['status'] = 'pending';

        Task::create($validated);

        return response()->json(['success' => true, 'message' => 'New Task Created!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function markComplete($id) {
        $task = Task::find($id);
        $task->status = 'completed';
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task marked as completed!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
        ]);

        $task = Task::find($id);
        $task->update($validated);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        
        return response()->json(['success' => true, 'message' => 'Task deleted successfully!']);
    }

    public function completedIndex () {
        $completedTasks = Task::where('status', 'completed')
                            ->orderBy('updated_at', 'asc')
                            ->orderBy('title', 'asc')
                            ->paginate(10);
        return view('dashboard.completed-tasks', compact('completedTasks'));
    }

    public function overdueIndex () {
        $overdueTasks = Task::where('status', 'pending')
                            ->whereDate('due_date', '<', Carbon::today())
                            ->orderBy('title', 'asc')
                            ->paginate(10);
        return view('dashboard.overdue-tasks', compact('overdueTasks'));
    }

    public function markPending($id) {
        $task = Task::find($id);
        $task->status = 'pending';
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task marked as pending!']);
    }
}
