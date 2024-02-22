<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStartedInternshipRequest;
use App\Http\Requests\UpdateStartedInternshipRequest;
use App\Models\StartedInternship;

class StartedInternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $startedInternshipsQuery = StartedInternship::with("companyPerson", "companyAddress", "internship")->select("*");
            // if (request()->has("id")) {
            //     $internshipsQuery->where("id", "=", request()->id);
            // }
            if (request()->has("meal_allowance") && request()->meal_allowance != "") {
                $startedInternshipsQuery->where("meal_allowance", "=", request()->meal_allowance);
            }
            if (request()->has("hourly_load") && request()->hourly_load != "") {
                $startedInternshipsQuery->where("hourly_load", "=", request()->hourly_load);
            }
            if (request()->has("start_date") && request()->start_date != "") {
                $startedInternshipsQuery->where("start_date", "like", "%" . request()->start_date . "%");
            }
            if (request()->has("end_date") && request()->end_date != "") {
                $startedInternshipsQuery->where("end_date", "like", "%" . request()->end_date . "%");
            }
            if (request()->has("company_address_id") && request()->company_address_id != "") {
                $startedInternshipsQuery->where("company_address_id", "=", request()->company_address_id);
            }
            if (request()->has("company_person_id") && request()->company_person_id != "") {
                $startedInternshipsQuery->where("company_person_id", "=", request()->company_person_id);
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $startedInternships = $startedInternshipsQuery->paginate($quantity);
            return response()->json($startedInternships, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStartedInternshipRequest $request)
    {
        $this->authorize('create', StartedInternship::class);
        try {
            $startedInternship = new StartedInternship();
            $startedInternship->internship_id = $request->internship_id;
            $startedInternship->start_date = $request->start_date;
            $startedInternship->end_date = $request->end_date;
            if ($request->has('meal_allowance')&& $request->meal_allowance != "") {
                $startedInternship->meal_allowance = $request->meal_allowance;
            }
            if ($request->has('company_address_id')&& $request->company_address_id != "") {
                $startedInternship->company_address_id = $request->company_address_id;
            }
            if ($request->has('company_person_id')&& $request->company_person_id != "") {
                $startedInternship->company_person_id = $request->company_person_id;
            }
            $startedInternship->save();
            return response()->json($startedInternship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StartedInternship $startedInternship)
    {
        try {
            $startedInternship = $startedInternship->load("companyPerson", "companyAddress", "internship");
            return response()->json($startedInternship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStartedInternshipRequest $request, StartedInternship $startedInternship)
    {
        $this->authorize('update', $startedInternship);
        try {
            // $startedInternship->internship_id = $request->internship_id;
            $startedInternship->start_date = $request->start_date;
            if ($request->has('meal_allowance')&& $request->meal_allowance != "") {
                $startedInternship->meal_allowance = $request->meal_allowance;
            }
            if ($request->has('company_address_id')&& $request->company_address_id != "") {
                $startedInternship->company_address_id = $request->company_address_id;
            }
            if ($request->has('company_person_id')&& $request->company_person_id != "") {
                $startedInternship->company_person_id = $request->company_person_id;
            }
            $startedInternship->save();
            return response()->json($startedInternship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StartedInternship $startedInternship)
    {
        $this->authorize('destroy', $startedInternship);
        try {
            $startedInternship->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
