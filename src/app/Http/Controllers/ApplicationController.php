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

            $applicationsQuery = Application::with("courses","company")->select("*");
            // if (request()->has("id")) {
            //     $applicationsQuery->where("id", "like", request()->id);
            // }
            if (request()->has("company_name") && request()->company_name != "") {
                $applicationsQuery->where("company_name", "like", "%" . request()->company_name . "%");
            }
            if (request()->has("number_students") && request()->number_students != "") {
                $applicationsQuery->where("number_students", "=", request()->number_students);
            }
            if (request()->has("activity_sector") && request()->activity_sector != "") {
                $applicationsQuery->where("activity_sector", "like", "%" . request()->activity_sector . "%");
            }
            if (request()->has("is_partner") && request()->is_partner != "") {
                $applicationsQuery->where("is_partner", "like", "%" . request()->is_partner . "%");
            }
            if (request()->has("contact_name") && request()->contact_name != "") {
                $applicationsQuery->where("contact_name", "like", "%" . request()->contact_name . "%");
            }
            if (request()->has("contact_telephone") && request()->contact_telephone != "") {
                $applicationsQuery->where("contact_telephone", "like", "%" . request()->contact_telephone . "%");
            }
            if (request()->has("contact_email") && request()->contact_email != "") {
                $applicationsQuery->where("contact_email", "like", "%" . request()->contact_email . "%");
            }
            if (request()->has("website") && request()->website != "") {
                $applicationsQuery->where("website", "like", "%" . request()->website . "%");
            }
            if (request()->has("locality") && request()->locality != "") {
                $applicationsQuery->where("locality", "like", "%" . request()->locality . "%");
            }
            if (request()->has("student_tasks") && request()->student_tasks != "") {
                $applicationsQuery->where("student_tasks", "like", "%" . request()->student_tasks . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $applications = $applicationsQuery->paginate($quantity);
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
        $this->authorize('create', Application::class);
        try {
            $application = new Application();
            $application->company_name = $request->company_name;
            $application->number_students = $request->number_students;
            $application->activity_sector = $request->activity_sector;
            $application->is_partner = $request->is_partner;
            $application->contact_name = $request->contact_name;
            $application->contact_telephone = $request->contact_telephone;
            $application->contact_email = $request->contact_email;
            $application->website = $request->website;
            $application->locality = $request->locality;
            $application->student_tasks = $request->student_tasks;
            //$application->student_profile = $request->student_profile;
            //$application->company_id = $request->company_id;
            //$application->is_valid = $request->is_valid;
            $application->save();
            $application -> courses() -> sync($request->courses);
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
            $application=$application->load('courses','company');
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
        $this->authorize('update', $application);
        try {
            $application->company_name = $request->company_name;
            $application->number_students = $request->number_students;
            $application->activity_sector = $request->activity_sector;
            $application->is_partner = $request->is_partner;
            $application->contact_name = $request->contact_name;
            $application->contact_telephone = $request->contact_telephone;
            $application->contact_email = $request->contact_email;
            $application->website = $request->website;
            $application->locality = $request->locality;
            $application->student_tasks = $request->student_tasks;
            $application->save();
            $application -> courses() -> sync($request->courses);
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
        $this->authorize('delete', $application);
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
