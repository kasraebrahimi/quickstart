<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskTransferController extends Controller
{
    public function index()
    {
      return view('transfers');
    }

    public function store()
    {
      return redirect('/transfers');
    }
}
