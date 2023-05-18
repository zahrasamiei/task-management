<?php
/**
 * Created by PhpStorm.
 * User: fatemeh.judy@zoodfood.com
 * Date: 2/8/23
 * Time: 2:13 PM
 */

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function getByFilters(array $data): LengthAwarePaginator
    {
        return $this->taskRepository->getByFilters($data);
    }

    public function create(array $data): int
    {
        $data['order'] = ($this->taskRepository->getLastOrder() + 1) ?? 1;

        return $this->taskRepository->create($data);
    }

    public function update(Task $task, array $data): void
    {
        $this->taskRepository->update($task, $data);
    }

    public function delete(Task $task): void
    {
        $this->taskRepository->delete($task);
    }

    public function updateOrder(string $ids): void
    {
        $arr = explode(',',$ids);

        foreach($arr as $sortOrder => $id){
            $this->taskRepository->updateOrder($id, $sortOrder);
        }
    }
}
