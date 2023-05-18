<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int               $id
 * @property int               $project_id
 * @property Project           $project
 * @property string            $name
 * @property string            $priority
 * @property int               $order
 * @property DateTimeInterface $created_at
 * @property DateTimeInterface $updated_at
 */
class Task extends Model
{
    use HasFactory;

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
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

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    public function setProjectId(int $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getProject(): Project
    {
        return $this->project;
    }
}
