<?php
namespace App\Repositories;

use App\Models\EventType;

class EventTypeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function index($request)
    {
        $query = EventType::query();

        $perPage   = $request->per_page ?? 10;
        $sortBy    = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'ASC';

        if ($request->has('filters')) {
            $filters = json_decode($request->query('filters'), true);

            foreach ($filters as $key => $value) {
                $query->where($key, 'like', "%{$value}%");
            }
        }

        return $query->orderBy($sortBy, $sortOrder)
            ->paginate($perPage);
    }
    public static function show($id)
    {
        return EventType::findOrFail($id);
    }

    public static function store($data)
    {
        $eventType = EventType::create([
            'name'        => $data['name'],
            'description' => $data['description'] ?? null,
            'status'      => $data['status'] ?? true,
        ]);

        return $eventType;
    }

    public static function update($data, $id)
    {
        $eventType = EventType::findOrFail($id);

        $eventType->update([
            'name'        => $data['name'],
            'description' => $data['description'] ?? $eventType->description,
            'status'      => $data['status'] ?? $eventType->status,
        ]);

        return $eventType;
    }

    public static function destroy($id)
    {
        return EventType::findOrFail($id)->delete();
    }
}
