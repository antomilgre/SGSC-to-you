<?php

namespace App\Http\Controllers\Api;

use App\Models\Registration;

class RegistrationController extends CrudController
{
    protected string $model = Registration::class;
    protected array $with = ['user', 'type'];
    protected array $rules = ['user_id' => 'required|exists:users,id', 'type_id' => 'required|exists:types,id', 'reference_id' => 'required|integer|min:1', 'registered_at' => 'required|date', 'status' => 'nullable|boolean'];
}
