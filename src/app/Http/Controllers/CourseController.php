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
        $courses = Course::all();
        return response()->json($courses, 200);
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

        $course = new Course();

        $course->name = $request->name;
        $course->area_id = $request->area_id;
        $course->course_type_id = $request->course_type_id;
        $course->save();
        return response()->json($course, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {

        return response()->json($course, 200);
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
        $course->update($request->all());
        return response()->json($course, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json(array('success' => 'Delete success'), 200);
    }
}
