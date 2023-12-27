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
            $internships = Internships::all();
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
