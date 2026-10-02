<?php

namespace App\Http\Controllers\Api;

use App\Models\Player;

class PlayerController extends CrudController
{
    protected string $model = Player::class;
    protected array $with = ['team.sport'];
    protected array $uploads = ['photo' => 'players'];
    protected array $rules = ['team_id' => 'required|exists:teams,id', 'name' => 'required|string|max:255', 'jersey_number' => 'nullable|integer|min:0', 'position' => 'nullable|string|max:255', 'age' => 'nullable|integer|min:1|max:120', 'photo' => 'nullable|image|max:5120', 'bio' => 'nullable|string'];
}
