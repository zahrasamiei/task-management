@component('layouts.content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">projects</h3>

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
                            <a href="{{ route('projects.create') }}" class="btn btn-info">create new projects</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>project id</th>
                                <th>project name</th>
                                <th>project description</th>
                                <th>operations</th>
                            </tr>

                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->getId() }}</td>
                                    <td>{{ $project->getName() }}</td>
                                    <td>{{ $project->getDescription() }}</td>
                                    <td class="d-flex">
                                        <form action="{{ route('projects.destroy' , ['project' => $project->getId()]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mr-1">delete</button>
                                        </form>
                                        <a href="{{ route('projects.edit' , ['project' => $project->getId()]) }}" class="btn btn-sm btn-primary mr-1">edit</a>
                                        <a href="{{ route('projects.show' , ['project' => $project->getId()]) }}" class="btn btn-sm btn-warning">show</a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $projects->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
