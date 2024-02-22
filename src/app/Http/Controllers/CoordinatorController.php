<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoordinatorRequest;
use App\Http\Requests\UpdateCoordinatorRequest;
use App\Models\Coordinator;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinatorsQuery = Coordinator::select("*");

        if (request()->has("name") && request()->name != "") {
            $coordinatorsQuery->where("name","like","%". request()->name ."%");
        }
        if (request()->has("email_atec") && request()->email_atec != "") {
            $coordinatorsQuery->where("email_atec","like","%". request()->email_atec ."%");
        }
        if (request()->has("phone_number") && request()->phone_number != "") {
            $coordinatorsQuery->where("phone_number","like","%". request()->phone_number ."%");
        }
        $quantity = isset(request()->quantity) ? request()->quantity : 15;
        $coordinators = $coordinatorsQuery->paginate($quantity);

        return response()->json($coordinators, 200);
    try {
    } catch (\Exception $exception) {
    }
        return response()->json([
            'message' => 'failed:' . $exception,
        ], 500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoordinatorRequest $request)
    {
        $this->authorize('create', Coordinator::class);
        try {
            $coordinator = new Coordinator();
            $coordinator->name = $request->name;
            $coordinator->email_atec = $request->email_atec;
            $coordinator->phone_number = $request->phone_number;
            $coordinator->save();

            return response()->json($coordinator, 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinator $coordinator)
    {
        try {
            return response()->json($coordinator, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoordinatorRequest $request, Coordinator $coordinator)
    {
        $this->authorize('update', $request);
        try {
            $coordinator->name = $request->name;
            $coordinator->email_atec = $request->email_atec;
            $coordinator->phone_number = $request->phone_number;
            $coordinator->save();
            return response()->json($coordinator, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coordinator $coordinator)
    {
        $this->authorize('delete', $coordinator);
        try {
            $coordinator->delete();
            return response()->json([
                'message' => 'Coordinator deleted successfully',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }
}
