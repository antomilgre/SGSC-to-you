<?php

namespace App\Http\Controllers\Api;

use App\Models\Sport;
use Illuminate\Validation\Rule;

class SportController extends CrudController
{
    protected string $model = Sport::class;
    protected array $with = ['teams'];
    protected array $rules = ['name' => 'required|string|max:255|unique:sports,name', 'description' => 'nullable|string', 'status' => 'nullable|boolean'];

    protected function updateRules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sports', 'name')->ignore(request()->route('sport'))],
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ];
    }
}
