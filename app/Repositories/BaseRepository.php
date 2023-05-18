<?php
/**
 * Created by PhpStorm.
 * User: Mehran.Mahmoudi@ZoodFood.Com
 * Date: 7/29/21
 * Time: 11:59 PM
 */

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use App\Exceptions\InvalidClassNameException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    private string $class;

    private Model $model;

    public function __construct(string $class)
    {
        $this->setClass($class);
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function createQueryBuilder(): Builder
    {
        return $this->getModel()->newQuery();
    }

    public function findById(int $id): Model|null
    {
        return $this->createQueryBuilder()->find($id);
    }

    public function findByIds(array $ids): array
    {
        return $this->createQueryBuilder()->whereIn('id', $ids)->get()->toArray();
    }

    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }

    public function deleteByCreatedAt(string $formattedDateTime, string $operator = '<')
    {
        do {
            $isDeleted = $this->createQueryBuilder()
                ->where('created_at', $operator, $formattedDateTime)
                ->limit(1000)->delete();
        } while ($isDeleted > 0);
    }

    private function setClass(string $class)
    {
        $this->class = $class;

        $model = app($class);

        if (!$model instanceof Model) {
            throw new InvalidClassNameException($class);
        }

        $this->setModel($model);
    }

    private function setModel(Model $model)
    {
        $this->model = $model;
    }
}
