@extends('layouts.app')

@section('content')
<h1>Transfer Requests</h1>
<br>

    @php
      $taskIsNotEmpty = false;
    @endphp
    @foreach ($allTransfers as $transfer)
      @if ($transfer['sender'] === auth()->user()->name)
        @php
          $taskIsNotEmpty = true;
        @endphp
      @endif
    @endforeach

    @if ($taskIsNotEmpty)
    <h2>List of Sent Requests</h2>
    <table class="table table-bordered">
      <thead>
        <tr class="bg-secondary" style="color: azure;">
          <th scope="col" class="text-center">Task Name</th>
          <th scope="col" class="text-center">Request Receiver</th>
          <th scope="col" class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($allTransfers as $transfer):
            if ($transfer['sender'] === auth()->user()->name) {
        ?>
        <tr>
          <td class="text-center">{{ $transfer['transferedTask'] }}</td>
          <td class="text-center">{{ $transfer['receiver'] }}</td>
          <td class="text-center">
            @if ($transfer['status'] == 0)
              <form method="POST" action="../canceled">
                @csrf
                  <input type="hidden" name="canceledTask" value="{{ $transfer['transferedTask'] }}">
                  <button class="btn btn-default" type="submit" name="button{{ $transfer['transferedTask'] }}Cancel">Cancel</button>
              </form>
            @endif

          </td>
        </tr>
      <?php
        }
      endforeach;
      ?>

      </tbody>
    </table>
    @else
    <div class="card card-body bg-secondary" style="color: azure;">
        <h3>No sent transfer requests!</h3>
    </div>
    @endif
<br>


    @php
      $taskIsNotEmpty = false;
    @endphp
    @foreach ($allTransfers as $transfer)
      @if ($transfer['receiver'] === auth()->user()->name)
        @php
          $taskIsNotEmpty = true;
        @endphp
      @endif
    @endforeach

    @if ($taskIsNotEmpty)
    <h2>List of Received Requests</h2>
    <table class="table table-bordered">
      <thead>
        <tr class="bg-secondary" style="color: azure;">
          <th scope="col" class="text-center">Task Name</th>
          <th scope="col" class="text-center">Request Sender</th>
          <th scope="col" class="text-center">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($allTransfers as $transfer):
            if ($transfer['receiver'] === auth()->user()->name) {
        ?>
        <tr>
          <td class="text-center">{{ $transfer['transferedTask'] }}</td>
          <td class="text-center">{{ $transfer['sender'] }}</td>
          <td class="text-center">
            @if ($transfer['status'] == 0)
              <form method="POST" action="#">
                  <button class="btn" style="background-color: royalblue; color: azure;" type="button" name="button{{ $transfer['transferedTask'] }}Accept">Accept</button>
                  <button class="btn" style="background-color: tomato; color:azure;" type="button" name="button{{ $transfer['transferedTask'] }}Reject">Reject</button>
              </form>
            @endif
          </td>
        </tr>
      <?php
        }
      endforeach;
      ?>

      </tbody>
    </table>
    @else
    <div class="card card-body bg-secondary" style="color: azure;">
        <h3>No incoming requests!</h3>
    </div>

    @endif


    @endsection
