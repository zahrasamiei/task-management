<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository extends BaseRepository
{
    public function findById(?int $id): ?Project
    {
        return $this->createQueryBuilder()->find($id);
    }

    public function getTicketingReasons(int $parentId = null, string $category = null): array
    {
        $qb = $this->createQueryBuilder();
        $qb
            ->where('is_active', '=', 1)
            ->whereNull('deleted_at');

        if ($parentId) {
            $qb
                ->where('parent_id', '=', $parentId);
        }

        if ($category) {
            $qb
                ->where('category', '=', $category);
        }

        return $qb->get()->all();
    }

    public function all(): Collection
    {
        return $this
            ->createQueryBuilder()
            ->get()
        ;
    }

    public function getByFilters(array $data): LengthAwarePaginator
    {
        $qb = $this->createQueryBuilder();

        if (isset($data['search'])) {
            $qb
                ->where('id', 'LIKE', sprintf('%%%s%%', $data['search']))
                ->orWhere('name', 'LIKE', sprintf('%%%s%%', $data['search']))
                ->orWhere('description', 'LIKE', sprintf('%%%s%%', $data['search']))
            ;
        }

        return $qb->paginate(10);
    }

    public function create(array $data): int
    {
        $project = new Project();

        $project
            ->setName($data['name'])
            ->setDescription($data['description'])
        ;

        $project->save();

        return $project->getId();
    }

    public function update(Project $project, array $data): void
    {
        $project
            ->setName($data['name'])
            ->setDescription($data['description'])
        ;

        $project->save();
    }
}
