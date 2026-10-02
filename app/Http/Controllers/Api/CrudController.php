<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class CrudController extends Controller
{
    /** @var class-string<Model> */
    protected string $model;
    protected array $rules = [];
    protected array $with = [];
    protected array $uploads = [];

    public function index(Request $request)
    {
        $model = $this->model;
        $query = $model::query()->with($this->with);
        $perPage = min(max((int) $request->integer('per_page', 15), 1), 100);
        $allowedSorts = array_merge(['id', 'created_at', 'updated_at'], (new $model)->getFillable());
        $sortBy = in_array($request->query('sort_by'), $allowedSorts, true) ? $request->query('sort_by') : 'created_at';
        $direction = strtolower($request->query('sort_order', 'desc')) === 'asc' ? 'asc' : 'desc';

        foreach ($request->only($this->filterableFields()) as $field => $value) {
            if ($value !== null && $value !== '') {
                $query->where($field, 'like', '%' . $value . '%');
            }
        }

        return $this->success($query->orderBy($sortBy, $direction)->paginate($perPage), 'Records retrieved');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
        $record = $this->createRecord($request, $data);
        return $this->success($record->load($this->with), 'Record created', 201);
    }

    public function show(string $id)
    {
        return $this->success($this->find($id), 'Record retrieved');
    }

    public function update(Request $request, string $id)
    {
        $record = $this->find($id);
        $data = $request->validate($this->updateRules());
        $this->updateRecord($request, $record, $data);
        return $this->success($record->fresh()->load($this->with), 'Record updated');
    }

    public function destroy(string $id)
    {
        $record = $this->find($id);
        $this->deleteUploads($record);
        $record->delete();
        return $this->success(null, 'Record deleted');
    }

    protected function createRecord(Request $request, array $data): Model
    {
        $model = $this->model;
        return $model::create($this->applyUploads($request, $data));
    }

    protected function updateRecord(Request $request, Model $record, array $data): void
    {
        $record->update($this->applyUploads($request, $data, $record));
    }

    protected function find(string $id): Model
    {
        $model = $this->model;
        return $model::with($this->with)->findOrFail($id);
    }

    protected function applyUploads(Request $request, array $data, ?Model $record = null): array
    {
        foreach ($this->uploads as $field => $directory) {
            if ($request->hasFile($field)) {
                if ($record?->{$field}) {
                    Storage::disk('public')->delete($record->{$field});
                }
                $data[$field] = $request->file($field)->store($directory, 'public');
            }
        }
        return $data;
    }

    protected function deleteUploads(Model $record): void
    {
        foreach (array_keys($this->uploads) as $field) {
            if ($record->{$field}) {
                Storage::disk('public')->delete($record->{$field});
            }
        }
    }

    protected function updateRules(): array
    {
        return array_map(fn ($rule) => is_string($rule) ? preg_replace('/(^|\\|)required(?=\\||$)/', '$1sometimes', $rule) : $rule, $this->rules);
    }

    protected function filterableFields(): array
    {
        $model = new $this->model;
        return $model->getFillable();
    }

    protected function success(mixed $data, string $message, int $status = 200)
    {
        return response()->json(['status' => true, 'message' => $message, 'data' => $data], $status);
    }
}
