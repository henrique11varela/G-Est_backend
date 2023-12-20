<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $areas = Area::all();
            return response()->json(['Message' => 'List of areas', 'Areas' => $areas], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['Message' => 'Error while getting areas', $e, 500]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        try
        {
            return response()->json(['Message' => 'Area found', 'Area' => $area], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['Message' => 'Error while getting area', $e, 500]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        try
        {
            //code...
        }
        catch (\Throwable $th)
        {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        try
        {
            $this->validate($request,['votes' => 'required']);
            $this->validate($request,['name' => 'required']);

            $area->votes = $request->votes;
            $area->name = $request->name;
            $area->save();

            return response()->json(['Message' => 'Area updated successfully', 'Area' => $area], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['Message' => 'Error while updating area', $e, 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        try
        {
            $area->delete();
            return response()->json(['Message' => 'Area deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['Message' => 'Error while deleting area', $e, 500]);
        }
    }
}
