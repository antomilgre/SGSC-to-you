<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EventTypeService;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $event = EventTypeService::index($request);

            return response()->json([
                'status'  => true,
                'messege' => 'Event Type Details',
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

            $eventType = EventTypeService::store($request);

            return response()->json([
                'status'  => true,
                'messege' => "Event Type {$eventType->id} created successfully",
                'data'    => $eventType,
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

            $eventType = EventTypeService::show($id);

            return response()->json([
                'status'  => true,
                'messege' => "Event Type Details",
                'data'    => $eventType,
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

            $eventType = EventTypeService::update($request, $id);

            return response()->json([
                'status'  => true,
                'messege' => "Event Type {$eventType->id} updated successfully",
                'data'    => $eventType,
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

            EventTypeService::destroy($id);

            return response()->json([
                'status'  => true,
                'messege' => 'Event Type deleted successfully',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status'  => false,
                'messege' => 'something went wrong',
                'error'   => $th->getMessage(),
            ], 500);

        }
    }
}
