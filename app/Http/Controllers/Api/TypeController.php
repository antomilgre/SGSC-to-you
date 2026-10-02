<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use Illuminate\Validation\Rule;

class TypeController extends CrudController
{
    protected string $model = Type::class;
    protected array $with = ['activities'];
    protected array $rules = ['name' => 'required|string|max:255|unique:types,name'];

    protected function updateRules(): array
    {
        return ['name' => ['sometimes', 'string', 'max:255', Rule::unique('types', 'name')->ignore(request()->route('type'))]];
    }
}
