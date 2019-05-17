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
      $transfer->sender = request()->all()['sender'];
      $transfer->receiver = request()->all()['receiver'];
      $transfer->transferedTask = request()->all()['transferedTask'];

      $transfer->save();



      return redirect('/transfers');
    }
}
