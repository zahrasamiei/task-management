@component('layouts.content')
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">show task information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="col-md-3">name</p>
                        <p class="col-md-9">{{ $task->getName() }}</p>
                    </div>
                    <div class="row">
                        <p class="col-md-3">project</p>
                        <p class="col-md-9">{{ $task->getproject()->getName() }}</p>
                    </div>
                    <div class="row">
                        <p class="col-md-3">order</p>
                        <p class="col-md-9">{{ $task->getOrder() }}</p>
                    </div>
                    <div class="row">
                        <p class="col-md-3">priority</p>
                        <p class="col-md-9">{{ $task->getPriority() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcomponent
