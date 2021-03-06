<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;


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


      // Getting other users
      $userNames = [];
      $usersData = \App\User::all()->toArray();
          foreach ($usersData as $index => $userArray) {
            if ($userArray['id'] !== auth()->id()) {
            array_push($userNames, $userArray['name']);
           }
          }

      // Getting all Transer Request Names
      $allTransfers = [];
      $allTransfers = \App\Transfer::all()->toArray();
      $numberOfTransfers = sizeof($allTransfers);
      $trTaskNames = [];
      $trTaskStatus = [];

      for ($i = 0; $i < $numberOfTransfers; $i++) {
          array_push($trTaskNames, $allTransfers[$i]['transferedTask']);
          $trTaskStatus[$allTransfers[$i]['transferedTask']] = $allTransfers[$i]['status'];
      }

      return view('tasks.index', [
          'tasks' => $this->tasks->forUser($request->user()),
          'userNames' => $userNames,
          'currentUser' => auth()->user()->name,
          'trTaskNames' => $trTaskNames,
          'trTaskStatus' => $trTaskStatus
      ]);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => ['required', 'max:255']
      ]);
      if (!\App\Task::where('name', $request->name)->exists()) {

        $request->user()->tasks()->create([
          'name' => $request->name,
        ]);

        return redirect('/tasks');
      } else {

        return redirect('/tasks')->withErrors('Task already exists.');
      }
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}
