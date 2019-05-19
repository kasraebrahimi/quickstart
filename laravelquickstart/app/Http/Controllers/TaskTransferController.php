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

    public function cancel()
    {
      // TODO delete transfer request from db.

      return redirect('/tasks');
    }

}
