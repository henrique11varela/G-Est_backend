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
        try {

            $areasQuery = Area::select("*");
            // if (request()->has("id")) {
            //     $areasQuery->where("id", "like", request()->id);
            // }
            if (request()->has("area_code") && request()->area_code != "") {
                $areasQuery->where("area_code", "like", "%" . request()->area_code . "%");
            }
            if (request()->has("name") && request()->name != "") {
                $areasQuery->where("name", "like", "%" . request()->name . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $areas = $areasQuery->get();
            return response()->json($areas, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        $this->authorize('create', $request);
        try {
            $area = new Area();
            $area->area_code = $request->area_code;
            $area->name = $request->name;
            $area->save();
            return response()->json($area, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        try {
            return response()->json($area, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $this->authorize('update', $request);
        try {
            $area->area_code = $request->area_code;
            $area->name = $request->name;
            $area->save();
            return response()->json($area, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $this->authorize('delete', $area);
        try {
            $area->delete();
            return response()->json(['message' => 'Area deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }
}
