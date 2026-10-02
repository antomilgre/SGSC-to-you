<?php

namespace App\Http\Controllers\Api;

use App\Models\MembershipApplication;

class MembershipApplicationController extends CrudController
{
    protected string $model = MembershipApplication::class;
    protected array $with = ['membership'];
    protected array $rules = ['membership_id' => 'required|exists:memberships,id', 'name' => 'required|string|max:255', 'email' => 'required|email|max:255', 'phone' => 'required|string|max:50', 'address' => 'nullable|string|max:255', 'status' => 'nullable|in:pending,approved,rejected'];
}
