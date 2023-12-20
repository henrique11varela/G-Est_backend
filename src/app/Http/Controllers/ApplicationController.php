<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use Exception;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $applications = Application::all();
            return response()->json($applications, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        try {
            $validator = Validator::make($request->all(), Application::validations());
            if ($validator->fails()) {
                throw new Exception("Error Processing Request", 1);
            }
            $application = new Application();
            $application->company_name = $request->company_name;
            $application->activity_sector = $request->activity_sector;
            $application->locality = $request->locality;
            $application->website = $request->website;
            $application->contact_name = $request->contact_name;
            $application->contact_telephone = $request->contact_telephone;
            $application->contact_email = $request->contact_email;
            $application->number_students = $request->number_students;
            $application->student_profile = $request->student_profile;
            $application->student_tasks = $request->student_tasks;
            $application->company_id = $request->company_id;
            $application->is_partner = $request->is_partner;
            $application->is_valid = $request->is_valid;
            $application->save();
            return response()->json($application, 201);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        try {
            return response()->json($application, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        try {
            $validator = Validator::make($request->all(), Application::validations());
            if ($validator->fails()) {
                throw new Exception("Error Processing Request", 1);
            }
            $application->company_name = $request->company_name;
            $application->activity_sector = $request->activity_sector;
            $application->locality = $request->locality;
            $application->website = $request->website;
            $application->contact_name = $request->contact_name;
            $application->contact_telephone = $request->contact_telephone;
            $application->contact_email = $request->contact_email;
            $application->number_students = $request->number_students;
            $application->student_profile = $request->student_profile;
            $application->student_tasks = $request->student_tasks;
            $application->company_id = $request->company_id;
            $application->is_partner = $request->is_partner;
            $application->is_valid = $request->is_valid;
            $application->save();
            return response()->json($application, 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        try {
            $application->delete();
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
