@component('layouts.content')
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">show project information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="col-md-3">name</p>
                        <p class="col-md-9">{{ $project->getName() }}</p>
                    </div>
                    <div class="row">
                        <p class="col-md-3">description</p>
                        <p class="col-md-9">{{ $project->getDescription() }}</p>
                    </div>
                    <div class="row">
                        <p class="col-md-12">tasks</p>
                        @include('projects.tasks', ['tasks' => $project->getTasks()])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcomponent
