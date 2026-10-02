<?php
namespace App\Services;

use App\Repositories\EventRepository;

class EventService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function index($data)
    {
        return EventRepository::index($data);
    }

    public static function store($data)
    {
        $data->validate([

            'title'         => 'required|string|max:255',

            'description'   => 'nullable|string',

            'event_type_id' => 'required|exists:event_types,id',

            'sport_id'      => 'required|exists:sports,id',

            'event_date'    => 'required|date',

            'event_time'    => 'nullable',

            'location'      => 'nullable|string|max:255',

            'status'        => 'nullable|in:upcoming,completed,cancelled',

            'team_ids'      => 'nullable|array',
            'team_ids.*'    => 'integer|exists:teams,id',

        ]);
        return EventRepository::store($data);
    }
    public static function update($data, $id)
    {
        $validatedData = $data->validate([

            'title'         => 'required|string|max:255',

            'description'   => 'nullable|string',

            'event_type_id' => 'required|exists:event_types,id',

            'sport_id'      => 'required|exists:sports,id',

            'event_date'    => 'required|date',

            'event_time'    => 'nullable',

            'location'      => 'nullable|string|max:255',

            'status'        => 'nullable|in:upcoming,completed,cancelled',

            'team_ids' => 'nullable|array',
            'team_ids.*' => 'integer|exists:teams,id',

        ]);

        return EventRepository::update($data, $id);
    }
    public static function destroy($id)
    {
        return EventRepository::destroy($id);
    }

    public static function show($id)
    {
        return EventRepository::show($id);
    }
}
