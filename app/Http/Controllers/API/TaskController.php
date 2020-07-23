<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
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
            ->with('user', 'company')
            ->orderBy('date')
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


        return Task::create([
            'title' => $request['title'],
            'status' => $request['status'],
            'user_id' => $request['user_id'],
            'company_id' => $request['company_id'],
            'date' => $request['date'],  
        ]);

    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $task = Task::findorfail($id);

        $task->update($request->all());
        return ['message' => "Succes"];
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $task = Task::findOrfail($id);

        //Delete the task

        $task->delete();

        return ['message' => 'User Deleted'];
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
        return Task::with('user', 'company')
        ->orderBy('date')
        ->paginate(50);

    }
}
