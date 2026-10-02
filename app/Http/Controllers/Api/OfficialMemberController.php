<?php

namespace App\Http\Controllers\Api;

use App\Models\OfficialMember;

class OfficialMemberController extends CrudController
{
    protected string $model = OfficialMember::class;
    protected array $with = ['role'];
    protected array $uploads = ['photo' => 'officials'];
    protected array $rules = ['role_id' => 'required|exists:official_roles,id', 'name' => 'required|string|max:255', 'photo' => 'nullable|image|max:5120', 'phone' => 'nullable|string|max:50', 'email' => 'nullable|email|max:255', 'description' => 'nullable|string', 'year_start' => 'nullable|integer|min:1900|max:2100', 'year_end' => 'nullable|integer|min:1900|max:2100|gte:year_start', 'status' => 'nullable|boolean'];
}
