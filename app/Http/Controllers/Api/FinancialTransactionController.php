<?php

namespace App\Http\Controllers\Api;

use App\Models\FinancialTransaction;

class FinancialTransactionController extends CrudController
{
    protected string $model = FinancialTransaction::class;
    protected array $with = ['user'];
    protected array $rules = ['user_id' => 'required|exists:users,id', 'type' => 'required|in:sport,activity', 'reference_id' => 'required|integer|min:1', 'registered_at' => 'required|date', 'status' => 'nullable|boolean'];
}
