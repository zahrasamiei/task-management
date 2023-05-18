<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int               $id
 * @property string            $name
 * @property Collection|null   $tasks
 * @property string            $description
 * @property DateTimeInterface $created_at
 * @property DateTimeInterface $updated_at
 */
class Project extends Model
{
    use HasFactory;

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id')->orderBy('tasks.order');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTasks(): Collection
    {
        return $this->tasks;
    }
}
