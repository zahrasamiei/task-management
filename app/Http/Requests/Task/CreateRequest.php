<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\TaskConstants;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'projectId'   => ['required', 'integer', 'exists:projects,id'],
            'priority'    => ['required', 'string', Rule::in(TaskConstants::PRIORITIES)],
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getProjectId(): int
    {
        return $this->input('projectId');
    }

    public function getPriority(): string
    {
        return $this->input('priority');
    }
}
