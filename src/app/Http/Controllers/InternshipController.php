<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternshipRequest;
use App\Http\Requests\UpdateInternshipRequest;
use App\Models\Internship;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $internshipsQuery = Internship::select("*");
            // if (request()->has("id")) {
            //     $internshipsQuery->where("id", "=", request()->id);
            // }
            if (request()->has("student_id") && request()->student_id != "") {
                $internshipsQuery->where("student_id", "like", "%" . request()->student_id . "%");
            }
            if (request()->has("meal_allowance") && request()->meal_allowance != "") {
                $internshipsQuery->where("meal_allowance", "like", "%" . request()->meal_allowance . "%");
            }
            if (request()->has("start_date") && request()->start_date != "") {
                $internshipsQuery->where("start_date", "like", "%" . request()->start_date . "%");
            }
            if (request()->has("address") && request()->address != "") {
                $internshipsQuery->where("address", "like", "%" . request()->address . "%");
            }
            if (request()->has("postcode") && request()->postcode != "") {
                $internshipsQuery->where("postcode", "like", "%" . request()->postcode . "%");
            }
            if (request()->has("observations") && request()->observations != "") {
                $internshipsQuery->where("observations", "like", "%" . request()->observations . "%");
            }
            if (request()->has("tutor_id") && request()->tutor_id != "") {
                $internshipsQuery->where("tutor_id", "like", "%" . request()->tutor_id . "%");
            }
            if (request()->has("company_id") && request()->company_id != "") {
                $internshipsQuery->where("company_id", "like", "%" . request()->company_id . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $internships = $internshipsQuery->paginate($quantity);
            return response()->json($internships, 200);
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
    public function store(StoreInternshipRequest $request)
    {
        try {
            $internship = new Internships();
            $internship->student_id = $request->student_id;
            $internship->meal_allowance = $request->meal_allowance;
            $internship->start_date = $request->start_date;
            $internship->address = $request->address;
            $internship->postcode = $request->postcode;
            $internship->tutor_id = $request->tutor_id;
            $internship->company_id = $request->company_id;
            $internship->save();
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
            return response()->json($internship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Internship $internship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternshipRequest $request, Internship $internship)
    {
        try {
            $internship->student_id = $request->student_id;
            $internship->meal_allowance = $request->meal_allowance;
            $internship->start_date = $request->start_date;
            $internship->address = $request->address;
            $internship->postcode = $request->postcode;
            $internship->tutor_id = $request->tutor_id;
            $internship->company_id = $request->company_id;
            $internship->update();
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
        try {
            $internship->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
