<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')

    @include('common.errors')
    <!-- Bootstrap Boilerplate... -->
    <div class="card">
        <!-- Display Validation Errors -->


        <!-- New Task Form -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group card-header">
                <label for="task-name" class="col-sm-3 control-label">New Task</label>

                <div class="input-group">
                    <input type="text" name="name" id="task-name" class="form-control" style="margin-right: 6px; border-radius: 5px;">
                    <span class="input-group-button">
                        <button type="submit" class="btn btn-success">Add Task</button>
                    </span>
                </div>
                <br>
            </div>

            <!-- Add Task Button -->
        </form>
    </div>

    <br>

    <!-- TODO: Current Tasks -->
    @if (count($tasks) > 0)
        <div class="card">
            <div class="card-header">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)


                        <!-- TODO: Delete Button -->
                        <tr>
                        <!-- Task Name -->
                        <td class="table-text">
                        <div>{{ $task->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>

                        <script type="text/javascript">
                        function triggerTransfer(user, usertask) {
                        if (window.confirm(`Are you sure you want to transfer this task to ${user}`)) {
                        document.getElementById(usertask).submit();
                        }
                        }
                        </script>

                        @if (!in_array($task->name, $trTaskNames) || $trTaskStatus[$task->name] !== 0)

                        <div class="dropright float-right">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Transfer to
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($userNames as $user)

                            <form method="POST" action="/transfers" id="{{ $user }}{{ $task->name }}">
                              {{ csrf_field() }}

                                  <input type="hidden" name="sender" value="{{ $currentUser }}">
                                  <input type="hidden" name="receiver" value="{{ $user }}">
                                  <input type="hidden" name="transferedTask" value="{{ $task->name }}">

                                  <a class="dropdown-item" href="javascript: {}" onclick="triggerTransfer('{{ $user }}', '{{ $user }}{{ $task->name }}');">{{ $user }}</a>

                            </form>

                            @endforeach


                            </div>
                         </div>
                        @else

                            <form method="POST" action="/canceled">
                              {{ csrf_field() }}

                              <input type="hidden" name="canceledTask" value="{{ $task->name }}">

                              <button class="btn btn-secondary float-right" type="submit" aria-haspopup="true" aria-expanded="false" name="cancel">Cancel Transfer</button>
                            </form>
                        @endif

                                        @php
                                          $disabled = ((in_array($task->name, $trTaskNames)) && $trTaskStatus[$task->name] === 0) ? "disabled" : "";
                                        @endphp
                                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger d-lg-inline col-auto float-right" style="margin-right: 4px; margin-left: 4px;" {{ $disabled }}>Delete Task</button>

                                        </form>



                                      </td>
                                  </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
