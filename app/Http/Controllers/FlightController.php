<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use Illuminate\Http\Request;

class FlightController extends Controller
{

    public function index()
    {
        $flights = Flight::all();
        return response()->json($flights);
    }
    public function store(Request $request)
    {
        $flight = Flight::create($request->all());
        return response()->json($flight, 201);
    }

    public function show($id)
    {
        $flight = Flight::find($id);
        $tasks = $flight->tasks;
        $query = $flight->tasks()->getQuery()->toSql();
        // dd($query);
        return response()->json([
            // 'tasks' => $tasks,
            'query' => $query,
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);
        if ($flight) {
            $flight->update([
                'name' => $request->name,
            ]);
            return response()->json($flight, 201);
        } else {
            return response()->json(['message' => 'Flight not found'], 404);
        }

    }

    public function destroy($id)
    {
        $flight = Flight::find($id);
        $flight->delete();
        return response()->json($flight, 201);
    }


    public function addTasksToFlight($id)
    {
        $flight = Flight::find($id);
        // Attach tasks to the flight
        $flight->tasks()->attach([1, 2, 3]);

        return response()->json(['message' => 'Tasks are assigns to Flight'], 200);
    }




}
