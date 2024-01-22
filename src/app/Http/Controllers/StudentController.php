<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $studentsQuery = Student::select("*");
            // if (request()->has("id")) {
            //     $studentsQuery->where("id","=", request()->id);
            // }
            if (request()->has("name") && request()->name != "") {
                $studentsQuery->where("name","like","%". request()->name ."%");
            }
            if (request()->has("personal_email") && request()->__personal_email__ != "") {
                $studentsQuery->where("personal_email","like","%". request()->personal_email ."%");
            }
            if (request()->has("atec_email") && request()->atec_email != "") {
                $studentsQuery->where("atec_email","like","%". request()->atec_email ."%");
            }
            if (request()->has("phone_number") && request()->phone_number != "") {
                $studentsQuery->where("phone_number","like","%". request()->phone_number ."%");
            }
            if (request()->has("address") && request()->address != "") {
                $studentsQuery->where("address","like","%". request()->address ."%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $students = $studentsQuery->with(['internships', 'studentCollections'])->paginate($quantity);

            return response()->json($students, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $student = new Student();
            $student->name = $request->name;
            $student->personal_email = $request->personal_email;
            $student->atec_email = $request->atec_email;
            $student->phone_number = $request->phone_number;
            $student->address = $request->address;
            $student->save();
            return response()->json($student, 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        try {
            $student->load('internships', 'studentCollections');
            return response()->json($student, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $student->name = $request->name;
            $student->personal_email = $request->personal_email;
            $student->atec_email = $request->atec_email;
            $student->phone_number = $request->phone_number;
            $student->address = $request->address;
            $student->save();
            return response()->json($student, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return response()->json([
                'message' => 'deleted',
                ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
                ], 500);
        }
    }
}
