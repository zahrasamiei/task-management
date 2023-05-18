@component('layouts.content')
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">edit project form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('projects.update', ['project' => $project->getId()]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="please enter project name" value="{{ $project->getName() }}">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="please enter project description" value="{{ $project->getDescription() }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">edit</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-default float-left">cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endcomponent
