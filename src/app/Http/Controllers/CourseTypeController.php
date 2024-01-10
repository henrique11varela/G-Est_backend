<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseTypeRequest;
use App\Http\Requests\UpdateCourseTypeRequest;
use App\Models\CourseType;
use Exception;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $courseTypesQuery = CourseType::select("*");
            // if (request()->has("id")) {
            //     $courseTypesQuery->where("id", "=", request()->id);
            // }
            if (request()->has("name")) {
                $courseTypesQuery->where("name", "like", "%" . request()->name . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $courseTypes = $courseTypesQuery->paginate($quantity);
            return response()->json($courseTypes, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseTypeRequest $request)
    {
        try {
            $courseType = new CourseType();
            $courseType->name = $request->name;
            $courseType->save();
            return response()->json($courseType, 201);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(int $id)
    // {
    //     try {
    //         $courseType = CourseType::find($id);
    //         return response()->json($courseType, 200);
    //     } catch (Exception $exception) {
    //         return response()->json([
    //             'message' => 'failed:' . $exception,
    //         ], 500);
    //     }
    // }
    public function show(CourseType $courseType)
    {
        try {
            return response()->json($courseType, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseTypeRequest $request, CourseType $courseType)
    {
        try {
            $courseType->name = $request->name;
            $courseType->save();
            return response()->json($courseType, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseType $courseType)
    {
        try {
            $courseType->delete();
            return response()->json([
                'message' => 'deleted',
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }
}
