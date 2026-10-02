<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;

class ActivityController extends CrudController
{
    protected string $model = Activity::class;
    protected array $with = ['type', 'registrations.user'];
    protected array $rules = ['title' => 'required|string|max:255', 'type_id' => 'required|exists:types,id', 'description' => 'nullable|string', 'date' => 'required|date', 'status' => 'nullable|boolean'];
}
