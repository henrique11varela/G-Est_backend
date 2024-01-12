<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $coursesQuery = Course::select("*");
            // if (request()->has("id")) {
            //     $coursesQuery->where("id", "=", request()->id);
            // }
            if (request()->has("name") && request()->name != "") {
                $coursesQuery->where("name", "like", "%" . request()->name . "%");
            }
            if (request()->has("course_type_id") && request()->course_type_id != "") {
                $coursesQuery->where("course_type_id", "like", "%" . request()->course_type_id . "%");
            }
            if (request()->has("area_id") && request()->area_id != "") {
                $coursesQuery->where("area_id", "like", "%" . request()->area_id . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $courses = $coursesQuery->paginate($quantity);
            return response()->json($courses, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
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
    public function store(StoreCourseRequest $request)
    {
        try {

            $course = new Course();

            $course->name = $request->name;
            $course->area_id = $request->area_id;
            $course->course_type_id = $request->course_type_id;
            $course->save();
            return response()->json($course, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        try {
            return response()->json($course, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        try {
            $course->name = $request->name;
            $course->area_id = $request->area_id;
            $course->course_type_id = $request->course_type_id;
            return response()->json($course, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
