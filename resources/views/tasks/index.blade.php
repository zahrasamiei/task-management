@component('layouts.content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">tasks</h3>

                    <div class="card-tools d-flex">
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="search" value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="btn-group-sm mr-1">
                            <a href="{{ route('tasks.create') }}" class="btn btn-info">create new tasks</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>task id</th>
                                <th>task name</th>
                                <th>task project</th>
                                <th>task priority</th>
                                <th>operations</th>
                            </tr>
                        </thead>
                        <tbody class="sort-tasks">
                            @foreach($tasks as $task)
                                <tr class="task-group-item" data-id="{{ $task->getId() }}">
                                    <td>{{ $task->getId() }}</td>
                                    <td>{{ $task->getName() }}</td>
                                    <td>{{ $task->getProject()->getName() }}</td>
                                    <td>{{ $task->getPriority() }}</td>
                                    <td class="d-flex">
                                        <form action="{{ route('tasks.destroy' , ['task' => $task->getId()]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mr-1">delete</button>
                                        </form>
                                        <a href="{{ route('tasks.edit' , ['task' => $task->getId()]) }}" class="btn btn-sm btn-primary mr-1">edit</a>
                                        <a href="{{ route('tasks.show' , ['task' => $task->getId()]) }}" class="btn btn-sm btn-warning">show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $tasks->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@section('script')
    <script>
        $('.sort-tasks').sortable({

            connectWith: '.task-group-item',

            ghostClass: "blue-background-class",

            update: function (e, ui){
                var sortData = $('.sort-tasks').sortable('toArray',{ attribute: 'data-id'})
                updateToDatabase(sortData.join(','))
            }

        });

        function updateToDatabase(idString){
            $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});

            $.ajax({
                url:'{{url('/tasks/update-order')}}',
                method:'POST',
                data:{ids:idString},
                success:function(){
                    // nothing :)
                }
            })
        }
    </script>
@endsection
@endcomponent
