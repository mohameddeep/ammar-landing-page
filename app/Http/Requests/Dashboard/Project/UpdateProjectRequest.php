<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Project;

use Illuminate\Validation\Rule;

final class UpdateProjectRequest extends StoreProjectRequest
{
    protected function imageRequirement(): string
    {
        return 'nullable';
    }

    protected function uniqueSlugRule()
    {
        return Rule::unique('projects', 'slug')->ignore((int) $this->route('project'));
    }
}
