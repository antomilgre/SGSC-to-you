<?php

namespace App\Http\Controllers\Api;

use App\Models\OfficialRole;

class OfficialRoleController extends CrudController
{
    protected string $model = OfficialRole::class;
    protected array $with = ['officials'];
    protected array $rules = ['role_name' => 'required|string|max:255', 'priority' => 'nullable|integer|min:0'];
}
