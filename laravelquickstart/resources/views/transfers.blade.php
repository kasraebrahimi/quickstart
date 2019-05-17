@extends('layouts.app')

@section('content')
<h1>Your request was sent.</h1>
<h2>List of Sent Requests</h2>

    <table class="table table-bordered">
      <thead>
        <tr class="bg-success">
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
          <td><?php echo $transfer['status'] == 0 ? 'Pending' : 'Done'; ?></td>
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
    <tr class="bg-success">
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
          <a href="">Pending</a>
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
