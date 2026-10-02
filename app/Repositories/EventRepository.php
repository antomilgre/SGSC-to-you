<?php
namespace App\Repositories;

use App\Models\Event;

class EventRepository
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
        $query = Event::with([
            'eventType',
            'sport',
            'teams',
        ]);

        $perPage = $data->per_page ?? 10;

        $sortBy    = $data->sort_by ?? 'created_at';
        $sortOrder = $data->sort_order ?? 'ASC';

        if ($data->has('filters')) {

            $filters = json_decode($data->query('filters'), true);

            foreach ($filters as $key => $value) {
                $query->where($key, 'like', "%{$value}%");
            }
        }

        return $query->orderBy($sortBy, $sortOrder)
            ->paginate($perPage);
    }
    public static function show($id)
    {
        return Event::with([
            'eventType',
            'sport',
            'teams',
        ])->findOrFail($id);
    }

    public static function store($data)
    {
        $event = new Event();

        $event->title         = $data->title;
        $event->description   = $data->description;
        $event->event_type_id = $data->event_type_id;
        $event->sport_id      = $data->sport_id;
        $event->event_date    = $data->event_date;
        $event->event_time    = $data->event_time;
        $event->location      = $data->location;
        $event->status        = $data->status ?? 'upcoming';

        $event->save();

        if ($data->has('team_ids')) {
            $event->teams()->sync($data->input('team_ids', []));
        }

        return $event->load([
            'eventType',
            'sport',
            'teams',
        ]);
    }

    public static function update($data, $id)
    {
        $event = Event::findOrFail($id);

        $event->title         = $data->title;
        $event->description   = $data->description;
        $event->event_type_id = $data->event_type_id;
        $event->sport_id      = $data->sport_id;
        $event->event_date    = $data->event_date;
        $event->event_time    = $data->event_time??$event->event_time;
        $event->location      = $data->location??$event->location;
        $event->status        = $data->status ?? $event->status;

        $event->save();

        if ($data->has('team_ids')) {
            $event->teams()->sync($data->input('team_ids', []));
        }

        return $event->load([
            'eventType',
            'sport',
            'teams',
        ]);
    }

    public static function destroy($id)
    {
        return Event::findOrFail($id)->delete();
    }
}
