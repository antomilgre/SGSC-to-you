<?php
namespace App\Services;

use App\Repositories\EventTypeRepository;

class EventTypeService
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
        return EventTypeRepository::index($request);
    }

    public static function show($id)
    {
        return EventTypeRepository::show($id);
    }

    public static function store($request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255|unique:event_types,name',
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',
        ]);

        return EventTypeRepository::store($validatedData);
    }

    public static function update($request, $id)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255|unique:event_types,name,' . $id,
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',
        ]);

        return EventTypeRepository::update($validatedData, $id);
    }

    public static function destroy($id)
    {
        return EventTypeRepository::destroy($id);
    }
}
