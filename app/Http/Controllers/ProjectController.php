<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use App\Http\Requests\Project\{CreateRequest, IndexRequest, UpdateRequest};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as FoundationApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ProjectController extends Controller
{
    private string $indexRoute = 'projects.index';

    public function __construct(private ProjectService $projectService)
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

        $projects = $this->projectService->getByFilters($data);

        return view('projects.index' , [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|FoundationApplication|View
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created reason and sub reason in storage.
     *
     */
    public function store(CreateRequest $createRequest): Application|FoundationApplication|RedirectResponse|Redirector
    {
        $data = [
            'name'        => $createRequest->getName(),
            'description' => $createRequest->getDescription(),
        ];

        $this->projectService->create($data);

        return redirect(route($this->indexRoute));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Project $project): Application|Factory|FoundationApplication|View
    {
        return view('projects.edit' , [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function show(Project $project): Application|Factory|FoundationApplication|View
    {
        return view('projects.show' , [
            'project' => $project
        ]);
    }

    /**
     *
     *  Update the specified resource in storage.
     */
    public function update(Project $project, UpdateRequest $updateRequest): RedirectResponse
    {
        $data = [
            'name'        => $updateRequest->getName(),
            'description' => $updateRequest->getDescription(),
        ];

        $this->projectService->update($project, $data);

        return redirect(route($this->indexRoute));
    }

    /**
     * delete the specified reason from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->projectService->delete($project);

        return back();
    }
}
