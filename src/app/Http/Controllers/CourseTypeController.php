<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseTypeRequest;
use App\Http\Requests\UpdateCourseTypeRequest;
use App\Models\CourseType;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Response;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        try {
            $courseTypes = CourseType::all();
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
    public function store(StoreCourseTypeRequest $request): Response
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
    public function show(CourseType $courseType): Response
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
    public function update(UpdateCourseTypeRequest $request, CourseType $courseType): Response
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
    public function destroy(CourseType $courseType): Response
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
