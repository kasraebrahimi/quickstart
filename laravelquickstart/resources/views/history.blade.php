@extends('layouts.app')

@section('content')

      <h2 class="text-center">Completed Transfers</h2>
      <table class="table table-bordered">
        <thead>
          <tr class="bg-secondary" style="color: azure;">
            <th scope="col" class="text-center">Transfered Task Name</th>
            <th scope="col" class="text-center">Requested by</th>
            <th scope="col" class="text-center">Received at</th>
            <th scope="col" class="text-center">Decided at</th>
            <th scope="col" class="text-center">Transfer Status</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($transfers as $transfer)
            @if ($transfer->receiver == auth()->user()->name)
          <tr>
            <td class="text-center">{{ $transfer->transferedTask }}</td>
            <td class="text-center">{{ $transfer->sender }}</td>
            <td class="text-center">{{ $transfer->created_at }}</td>
            <td class="text-center">{{ $transfer->updated_at }}</td>
            <td class="text-center">{{ $transfer->status > 1 ? 'Rejected' : 'Accepted' }}</td>
          </tr>
            @endif
          @endforeach
        </tbody>

      </table>

@endsection
