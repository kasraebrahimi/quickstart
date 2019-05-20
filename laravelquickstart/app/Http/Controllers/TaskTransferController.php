<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskTransferController extends Controller
{
    public function index()
    {
      $allTransfers = \App\Transfer::all()->toArray();
      return view('transfers', compact('allTransfers'));
    }

    public function store(Request $request)
    {
      $transfer = new \App\Transfer;
      $transfer->sender = $request->sender;
      $transfer->receiver = $request->receiver;
      $transfer->transferedTask = $request->transferedTask;
      $transfer->save();

      return redirect('/transfers');
    }

    public function cancel(Request $request)
    {
      \App\Transfer::where('transferedTask', $request->canceledTask)->delete();
      return redirect('/tasks');
    }

    public function accept(Request $request)
    {
      $taskName = $request->acceptedTask;

      \App\Task::where('name', $taskName)->update(['user_id' => auth()->user()->id]);

      \App\Transfer::where('transferedTask', $taskName)->update(['status' => 1]);

      return redirect('/transfers');
    }

    public function reject(Request $request)
    {
      $taskName = $request->rejectedTask;

      \App\Transfer::where('transferedTask', $taskName)->update(['status' => 2]);

      return redirect('/transfers');
    }

    public function history()
    {
      $transfers = \App\Transfer::where('status', '>', 0)->orderBy('updated_at', 'desc')->get()->all();

      return view('history', ['transfers' => $transfers]);
    }
}
