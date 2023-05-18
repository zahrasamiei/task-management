<?php
/**
 * Created by PhpStorm.
 * User: fatemeh.judy@zoodfood.com
 * Date: 2/8/23
 * Time: 2:13 PM
 */

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function getByFilters(array $data): LengthAwarePaginator
    {
        return $this->projectRepository->getByFilters($data);
    }

    public function all(): Collection
    {
        return $this->projectRepository->all();
    }

    public function create(array $data): int
    {
        return $this->projectRepository->create($data);
    }

    public function update(Project $project, array $data): void
    {
        $this->projectRepository->update($project, $data);
    }

    public function delete(Project $project): void
    {
        $this->projectRepository->delete($project);
    }
}
