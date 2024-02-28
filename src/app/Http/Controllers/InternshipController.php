<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternshipRequest;
use App\Http\Requests\UpdateInternshipRequest;
use App\Models\Internship;
use App\Models\StartedInternship;
use App\Models\EndedInternship;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $internshipsQuery = Internship::with("startedInternship.companyAddress", "startedInternship.companyPerson", "endedInternship", "student", "studentCollection", "companies.companyAddresses", "companies.tutorPeople")->select("*");
            // if (request()->has("id")) {
            //     $internshipsQuery->where("id", "=", request()->id);
            // }
            if (request()->has("student_id") && request()->student_id != "") {
                $internshipsQuery->where("student_id", "=", request()->student_id);
            }
            if (request()->has("student_collection_id") && request()->student_collection_id != "") {
                $internshipsQuery->where("student_collection_id", "=", request()->student_collection_id);
            }
            if (request()->has("observations") && request()->observations != "") {
                $internshipsQuery->where("observations", "like", "%" . request()->observations . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $internships = $internshipsQuery->paginate($quantity);
            // dd($internships);
            return response()->json($internships, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternshipRequest $request)
    {
        $this->authorize('create', Internship::class);
        try {
            $internship = new Internship();
            $internship->student_id = $request->student_id;
            $internship->student_collection_id = $request->student_collection_id;
            $internship->observations = $request->observations;
            $internship->save();
            $companiesArray = [];
            foreach ($request->companies as $company) {
                $companiesArray[$company['id']] = ['status' => $company['status']];
            }
            $internship->companies()->sync($companiesArray);
            if ($request->has('started_internship') && $request->started_internship != null) {
                $startedInternship = new StartedInternship();
                $startedInternship->internship_id = $internship->id;
                $startedInternship->start_date = $request->started_internship['start_date'];
                $startedInternship->end_date = $request->started_internship['end_date'];
                $startedInternship->meal_allowance = $request->started_internship['meal_allowance'];
                $startedInternship->hq_shipping_address = $request->started_internship['hq_shipping_address'];
                $startedInternship->hourly_load = $request->started_internship['hourly_load'];
                if (isset($request->started_internship['company_address_id']) && $request->started_internship['company_address_id'] != "") {
                    $startedInternship->company_address_id = $request->started_internship['company_address_id'];
                }
                if (isset($request->started_internship['company_person_id']) && $request->started_internship['company_person_id'] != "") {
                    $startedInternship->company_person_id = $request->started_internship['company_person_id'];
                }
                $startedInternship->save();
            }
            if ($request->has('ended_internship') && $request->ended_internship != null) {
                $endedInternship = new EndedInternship();
                $endedInternship->internship_id = $internship->id;
                $endedInternship->reason = $request->ended_internship['reason'];
                $endedInternship->situacao_prof = $request->ended_internship['situacao_prof'];
                $endedInternship->como_obteve_emprego = $request->ended_internship['como_obteve_emprego'];
                $endedInternship->save();
            }
            return response()->json($internship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Internship $internship)
    {
        try {
            $internship = $internship->load("startedInternship.companyAddress", "startedInternship.companyPerson", "endedInternship", "student", "studentCollection", "companies.companyAddresses", "companies.tutorPeople");
            return response()->json($internship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternshipRequest $request, Internship $internship)
    {
        $this->authorize('update', $internship);
        try {
            $endedInternship = EndedInternship::where("internship_id", "=", $internship->id)->first();
            $internship->student_id = $request->student_id;
            $internship->student_collection_id = $request->student_collection_id;
            $internship->observations = $request->observations;
            $companiesArray = [];
            foreach ($request->companies as $company) {
                $companiesArray[$company['id']] = ['status' => $company['status']];
            }
            $internship->save();
            $internship->companies()->sync($companiesArray);

            if ($request->has('started_internship') && $request->started_internship != null) {
                $startedInternship = StartedInternship::where("internship_id", "=", $internship->id)->first();

                if (!$startedInternship) {
                    $startedInternship = new StartedInternship();
                }

                $startedInternship->internship_id = $internship->id;
                $startedInternship->start_date = $request->started_internship['start_date'];
                $startedInternship->end_date = $request->started_internship['end_date'];
                $startedInternship->meal_allowance = $request->started_internship['meal_allowance'];
                $startedInternship->hq_shipping_address = $request->started_internship['hq_shipping_address'];
                $startedInternship->hourly_load = $request->started_internship['hourly_load'];
                if (isset($request->started_internship['company_address_id']) && $request->started_internship['company_address_id'] != "") {
                    $startedInternship->company_address_id = $request->started_internship['company_address_id'];
                }
                if (isset($request->started_internship['company_person_id']) && $request->started_internship['company_person_id'] != "") {
                    $startedInternship->company_person_id = $request->started_internship['company_person_id'];
                }
                $startedInternship->save();
            }

            if ($request->has('ended_internship') && $request->ended_internship != null) {
                // dd($request->ended_internship);
                $endedInternship = EndedInternship::where("internship_id", "=", $internship->id)->first();
                if (!$endedInternship) {
                    $endedInternship = new EndedInternship();
                }
                $endedInternship->internship_id = $internship->id;
                $endedInternship->reason = $request->ended_internship['reason'];
                $endedInternship->situacao_prof = $request->ended_internship['situacao_prof'];
                $endedInternship->como_obteve_emprego = $request->ended_internship['como_obteve_emprego'];
                $endedInternship->save();
            }
            // $internship = $internship->load("startedInternship.companyAddress", "startedInternship.companyPerson", "endedInternship", "student", "studentCollection", "companies.companyAddresses", "companies.tutorPeople");
            return response()->json($internship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internship $internship)
    {
        $this->authorize('delete', $internship);
        try {
            $startedInternship = StartedInternship::where("internship_id", "=", $internship->id)->first();
            if ($startedInternship) {
                $startedInternship->delete();
            }
            $endedInternship = EndedInternship::where("internship_id", "=", $internship->id)->first();
            if ($endedInternship) {
                $endedInternship->delete();
            }
            $internship->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
