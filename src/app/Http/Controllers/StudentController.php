<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Exception;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = Student::all();
            return response()->json($students, 200);
        } catch (Exception $exception) {
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
            $validator = Validator::make($request->all(), Student::$validations);
            if ($validator->fails()) {
                throw new Exception("Error Processing Request", 1);
            }
            $student = new Student();
            $student->name = $request->name;
            $student->personal_email = $request->personal_email;
            $student->atec_email = $request->atec_email;
            $student->phone_number = $request->phone_number;
            $student->save();
            return response()->json($student, 201);
        } catch (Exception $exception) {
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
            return response()->json($student, 200);
        } catch (Exception $exception) {
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
            $validator = Validator::make($request->all(), Student::$validations);
            if ($validator->fails()) {
                throw new Exception("Error Processing Request", 1);
            }
            $student->name = $request->name;
            $student->personal_email = $request->personal_email;
            $student->atec_email = $request->atec_email;
            $student->phone_number = $request->phone_number;
            $student->save();
            return response()->json($student, 200);
        } catch (Exception $exception) {
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
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
                ], 500);
        }
    }
}
