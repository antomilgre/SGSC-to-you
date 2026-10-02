<?php
namespace App\Http\Controllers\Api;

use App\Models\Club;

class ClubController extends CrudController
{
    protected string $model = Club::class;
    protected array $uploads = ['logo' => 'clubs'];
    protected array $rules = ['name' => 'required|string|max:255', 'register_no' => 'required|string|max:255', 'logo' => 'nullable|image|max:5120', 'description' => 'nullable|string', 'mission' => 'nullable|string', 'vision' => 'nullable|string', 'founded_year' => 'nullable|integer|min:1800|max:2100', 'address' => 'nullable|string|max:255', 'phone' => 'nullable|string|max:50', 'email' => 'nullable|email|max:255'];
}
