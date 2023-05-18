@component('layouts.content')
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">edit task form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('tasks.update', ['task' => $task->getId()]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="please enter task name" value="{{ $task->getName() }}">
                        </div>
                        <div class="form-group">
                            <label for="projectId" class="col-sm-2 control-label">project</label>
                            <select name="projectId" id="projectId" class="form-control">
                                @foreach($projects as $project)
                                    <option value="{{ $project->getId() }}" @if($project->getId() == $task->getProjectId()) selected="selected" @endif>{{ $project->getName() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priority" class="col-sm-2 control-label">priority</label>
                            <select name="priority" id="priority" class="form-control">
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority }}" @if($priority == $task->getPriority()) selected="selected" @endif>{{ $priority }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">edit</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-default float-left">cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
