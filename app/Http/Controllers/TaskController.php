<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Http\Requests\Task\{CreateRequest, IndexRequest, UpdateOrderRequest, UpdateRequest};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\Constants\TaskConstants;

class TaskController extends Controller
{
    private string $indexRoute = 'tasks.index';

    public function __construct(
        private TaskService    $taskService,
        private ProjectService $projectService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(IndexRequest $indexRequest): Application|Factory|View|FoundationApplication
    {
         $data = [
            'search' => $indexRequest->getSearch(),
        ];

        $tasks = $this->taskService->getByFilters($data);

        return view('tasks.index' , [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|FoundationApplication|View
     */
    public function create()
    {
        $priorities = TaskConstants::PRIORITIES;
        $projects   = $this->projectService->all();

        return view('tasks.create', [
            'priorities' => $priorities,
            'projects'   => $projects,
        ]);
    }

    /**
     * Store a newly created reason and sub reason in storage.
     *
     */
    public function store(CreateRequest $createRequest): Application|FoundationApplication|RedirectResponse|Redirector
    {
        $data = [
            'name'      => $createRequest->getName(),
            'priority'  => $createRequest->getPriority(),
            'projectId' => $createRequest->getProjectId(),
        ];

        $this->taskService->create($data);

        return redirect(route($this->indexRoute));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Task $task): Application|Factory|FoundationApplication|View
    {
        $priorities = TaskConstants::PRIORITIES;
        $projects   = $this->projectService->all();

        return view('tasks.edit' , [
            'task'       => $task,
            'projects'   => $projects,
            'priorities' => $priorities,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function show(Task $task): Application|Factory|FoundationApplication|View
    {
        return view('tasks.show' , [
            'task' => $task
        ]);
    }

    /**
     *
     *  Update the specified resource in storage.
     */
    public function update(Task $task, UpdateRequest $updateRequest): RedirectResponse
    {
        $data = [
            'name'      => $updateRequest->getName(),
            'priority'  => $updateRequest->getPriority(),
            'projectId' => $updateRequest->getProjectId(),
        ];

        $this->taskService->update($task, $data);

        return redirect(route($this->indexRoute));
    }

    /**
     * delete the specified reason from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->taskService->delete($task);

        return back();
    }

    public function updateOrder(UpdateOrderRequest $updateOrderRequest): JsonResponse
    {
        $ids = $updateOrderRequest->getIds();

        $this->taskService->updateOrder($ids);

        return $this->success([]);
    }
}
