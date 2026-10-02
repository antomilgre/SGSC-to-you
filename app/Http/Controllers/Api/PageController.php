<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Validation\Rule;

class PageController extends CrudController
{
    protected string $model = Page::class;
    protected array $rules = ['title' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:pages,slug', 'content' => 'required|string'];

    protected function updateRules(): array
    {
        $rules = parent::updateRules();
        $rules['slug'] = ['sometimes', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore(request()->route('page'))];
        return $rules;
    }
}
