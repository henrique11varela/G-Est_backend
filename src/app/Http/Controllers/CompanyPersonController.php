<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyPersonRequest;
use App\Http\Requests\UpdateCompanyPersonRequest;
use App\Models\CompanyPerson;

class CompanyPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companyPeople = CompanyPerson::all();
            return response()->json($companyPeople, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyPersonRequest $request)
    {
        try {
            $companyPerson = new CompanyPerson();
            $companyPerson->name = $request->name;
            $companyPerson->phone_number = $request->phone_number;
            $companyPerson->email = $request->email;
            $companyPerson->company_id = $request->company_id;
            $companyPerson->is_tutor = $request->is_tutor;
            $companyPerson->is_contact = $request->is_contact;
            $companyPerson->save();
            return response()->json($companyPerson, 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyPerson $companyPerson)
    {
        try {
            return response()->json($companyPerson, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyPersonRequest $request, CompanyPerson $companyPerson)
    {
        try {
            $companyPerson->name = $request->name;
            $companyPerson->phone_number = $request->phone_number;
            $companyPerson->email = $request->email;
            $companyPerson->company_id = $request->company_id;
            $companyPerson->is_tutor = $request->is_tutor;
            $companyPerson->is_contact = $request->is_contact;
            $companyPerson->save();
            return response()->json($companyPerson, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'failed:' . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyPerson $companyPerson)
    {
        try {
            $companyPerson->delete();
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
