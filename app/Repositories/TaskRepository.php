<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository extends BaseRepository
{
    public function create(array $data): int
    {
        $task = new Task();

        $task
            ->setName($data['name'])
            ->setOrder($data['order'])
            ->setPriority($data['priority'])
            ->setProjectId($data['projectId'])
        ;

        $task->save();

        return $task->getId();
    }

    public function getLastOrder(): ?int
    {
        return $this
            ->createQueryBuilder()
            ->latest('order')
            ->first()
            ?->getOrder()
        ;
    }

    public function getByFilters(array $data): LengthAwarePaginator
    {
        $qb = $this->createQueryBuilder();

        if (isset($data['search'])) {
            $qb
                ->where('id', 'LIKE', sprintf('%%%s%%', $data['search']))
                ->orWhere('name', 'LIKE', sprintf('%%%s%%', $data['search']))
                ->orWhere('priority', 'LIKE', sprintf('%%%s%%', $data['search']))
            ;
        }

        return $qb->orderBy('order')->paginate(10);
    }

    public function findById(int $id): Task|null
    {
        return $this->createQueryBuilder()->find($id);
    }

    public function update(Task $task, array $data): void
    {
        $task
            ->setName($data['name'])
            ->setPriority($data['priority'])
            ->setProjectId($data['projectId'])
        ;

        $task->save();
    }

    public function updateOrder(int $id, int $order): void
    {
        $qb = $this->createQueryBuilder();

        $qb
            ->where('id', $id)
            ->update(['order' => $order])
        ;
    }
}
