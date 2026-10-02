<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $event = EventService::index($request);
            return response()->json([
                'status'  => true,
                'messege' => "Event Type Details",
                'data'    => $event,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'messege' => 'something went wrong',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $event = EventService::store($request);
            return response()->json([
                'status'  => true,
                'messege' => "Event Stored successfully",
                'data'    => $event,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'messege' => 'something went wrong',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $event = EventService::show($id);
            return response()->json([
                'status'  => true,
                'messege' => "Event Details",
                'data'    => $event,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'messege' => 'something went wrong',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $event = EventService::update($request, $id);
            return response()->json([
                'status'  => true,
                'messege' => "Event {$event->id} Updated ",
                'data' => $event,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'messege' => 'something went wrong',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = EventService::destroy( $id);
            return response()->json([
                'status'  => true,
                'messege' => "Event  Deleted ",
                'data' => $event,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'messege' => 'something went wrong',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    public function syncTeams(Request $request, string $id)
    {
        $data = $request->validate([
            'team_ids' => 'present|array',
            'team_ids.*' => 'integer|exists:teams,id',
        ]);

        $event = Event::findOrFail($id);
        $event->teams()->sync($data['team_ids']);

        return response()->json([
            'status' => true,
            'message' => 'Event teams updated',
            'data' => $event->fresh()->load(['eventType', 'sport', 'teams']),
        ]);
    }
}
