<?php

namespace App\Http\Controllers\Api;

use App\Models\Membership;

class MembershipController extends CrudController
{
    protected string $model = Membership::class;
    protected array $with = ['applications'];
    protected array $rules = ['title' => 'required|string|max:255', 'fee' => 'nullable|numeric|min:0', 'duration' => 'nullable|integer|min:1', 'benefits' => 'nullable|string', 'status' => 'nullable|boolean'];
}
