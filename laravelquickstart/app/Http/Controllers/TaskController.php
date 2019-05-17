<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App;
use App\User;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
      $this->middleware('auth');
      $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
      $userNames = [];
      $usersData = App\User::all()->toArray();
          foreach ($usersData as $index => $userArray) {
            if ($userArray['id'] !== auth()->id()) {
            array_push($userNames, $userArray['name']);
           }
          }


      return view('tasks.index', [
          'tasks' => $this->tasks->forUser($request->user()),
          'userNames' => $userNames
      ]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => ['required', 'max:255']
      ]);

      $request->user()->tasks()->create([
        'name' => $request->name,
      ]);

    return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }

    public function test()
    {

      dd($_POST);
    }
}
