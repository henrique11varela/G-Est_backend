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

            $coursesQuery = Course::with("area")->select("*");
            // if (request()->has("id")) {
            //     $coursesQuery->where("id", "=", request()->id);
            // }
            if (request()->has("name") && request()->name != "") {
                $coursesQuery->where("name", "like", "%" . request()->name . "%");
            }
            if (request()->has("type") && request()->type != "") {
                $coursesQuery->where("type", "like", "%" . request()->type . "%");
            }
            if (request()->has("area_id") && request()->area_id != "") {
                $coursesQuery->where("area_id", "like", "%" . request()->area_id . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $courses = $coursesQuery->get();
            return response()->json($courses, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
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
            $course->type = $request->type;
            $course->hourly_load = $request->hourly_load;
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
            $course->load("area");
            return response()->json($course, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        try {
            $course->name = $request->name;
            $course->area_id = $request->area_id;
            $course->type = $request->type;
            $course->hourly_load = $request->hourly_load;
            $course->save();
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
