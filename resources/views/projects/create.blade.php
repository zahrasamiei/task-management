@component('layouts.content')
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">create project form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="please enter project name">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="please enter project description">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">create</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-default float-left">cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
@endcomponent
