<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends CrudController
{
    protected string $model = News::class;
    protected array $uploads = ['image' => 'news'];
    protected array $rules = ['title' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:news,slug', 'content' => 'required|string', 'image' => 'nullable|image|max:5120', 'published_at' => 'nullable|date', 'status' => 'nullable|boolean'];

    protected function updateRules(): array
    {
        $rules = parent::updateRules();
        $rules['slug'] = ['sometimes', 'string', 'max:255', Rule::unique('news', 'slug')->ignore(request()->route('news'))];
        return $rules;
    }
}
