<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        // paginate the authorized user's tasks with 5 per page
        $tasks = auth('api')->user()
            ->tasks()
            ->orderBy('status') 
            ->orderByDesc('created_at')
            ->paginate(25);

        // return task index view with paginated tasks
        return $tasks;
    }

    /**
     * Store a new incomplete task for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        // // create a new incomplete task with the given title
        // auth('api')->user()->tasks()->create([
        //     'title' => $data['title'],
        //     'status' => $data['status'],
        // ]);

        return Task::create([
            'title' => $request['title'],
            'status' => $request['status'],
            'user_id' => $request['user_id'],
            
        ]);

        // // flash a success message to the session
        // session()->flash('status', 'Task Created!');

        // // redirect to tasks index
        // return redirect('/verzoeken');
    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Task $task)
    {
        // check if the authenticated user can complete the task
        $this->authorize('complete', $task);

        // mark the task as complete and save it
        $task->is_complete = true;
        $task->save();

        // flash a success message to the session
        session()->flash('status', 'Task Completed!');

        // redirect to tasks index
        return redirect('/tasks');
    }
        /**
     * Paginate the authenticated user's tasks.
     *
     * @return \Illuminate\View\View
     */
    public function allTasks()
    {

        // // paginate the authorized user's tasks with 5 per page
        // $tasks = auth('api')->user()
        //     ->tasks()
        //     ->orderBy('is_complete') 
        //     ->orderByDesc('created_at')
        //     ->paginate(25); 

        // return task index view with paginated tasks
        return Task::with('user')->latest()->paginate(50);
    }
}
