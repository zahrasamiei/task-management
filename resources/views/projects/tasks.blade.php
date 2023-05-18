@if($tasks->empty() == false)
    <table class="table table-hover">
        <tbody>
        <tr>
            <th>task id</th>
            <th>task name</th>
            <th>task priority</th>
        </tr>

        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->getId() }}</td>
                <td>{{ $task->getName() }}</td>
                <td>{{ $task->getPriority() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif
