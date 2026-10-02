<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;

class TeamController extends CrudController
{
    protected string $model = Team::class;
    protected array $with = ['sport', 'players'];
    protected array $rules = ['sport_id' => 'required|exists:sports,id', 'name' => 'required|string|max:255', 'category' => 'nullable|string|max:255', 'coach_name' => 'nullable|string|max:255', 'description' => 'nullable|string'];
}
