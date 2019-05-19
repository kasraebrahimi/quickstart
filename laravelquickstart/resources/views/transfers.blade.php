@extends('layouts.app')

@section('content')
<h1>Your request was sent.</h1>
<h2>List of Sent Requests</h2>

    <table class="table table-bordered">
      <thead>
        <tr class="bg-info">
          <th scope="col">Task Name</th>
          <th scope="col">Request Receiver</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($allTransfers as $transfer):
            if ($transfer['sender'] === auth()->user()->name) {
        ?>
        <tr>
          <td>{{ $transfer['transferedTask'] }}</td>
          <td>{{ $transfer['receiver'] }}</td>
          <td>
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

<h2>List of Received Requests</h2>
<table class="table table-bordered">
  <thead>
    <tr class="bg-info">
      <th scope="col">Task Name</th>
      <th scope="col">Request Sender</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($allTransfers as $transfer):
        if ($transfer['receiver'] === auth()->user()->name) {
    ?>
    <tr>
      <td>{{ $transfer['transferedTask'] }}</td>
      <td>{{ $transfer['sender'] }}</td>
      <td>
        @if ($transfer['status'] == 0)
          <form method="POST" action="#">
              <button class="btn btn-success" type="button" name="button{{ $transfer['transferedTask'] }}Accept">Accept</button>
              <button class="btn btn-danger" type="button" name="button{{ $transfer['transferedTask'] }}Reject">Reject</button>
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


@endsection
