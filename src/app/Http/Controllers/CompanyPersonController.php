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

            $companyPeopleQuery = CompanyPerson::select("*");
            // if (request()->has("id")) {
            //     $companyPeopleQuery->where("id", "=", request()->id);
            // }
            if (request()->has("name") && request()->name != "") {
                $companyPeopleQuery->where("name", "like", "%" . request()->name . "%");
            }
            if (request()->has("phone_number") && request()->phone_number != "") {
                $companyPeopleQuery->where("phone_number", "like", "%" . request()->phone_number . "%");
            }
            if (request()->has("email") && request()->email != "") {
                $companyPeopleQuery->where("email", "like", "%" . request()->email . "%");
            }
            if (request()->has("company_id") && request()->company_id != "") {
                $companyPeopleQuery->where("company_id", "like", "%" . request()->company_id . "%");
            }
            if (request()->has("is_tutor") && request()->is_tutor != "") {
                $companyPeopleQuery->where("is_tutor", "like", "%" . request()->is_tutor . "%");
            }
            if (request()->has("is_contact") && request()->is_contact != "") {
                $companyPeopleQuery->where("is_contact", "like", "%" . request()->is_contact . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $companyPeople = $companyPeopleQuery->paginate($quantity);
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
        $this->authorize('create', $request);
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
            $companyPerson->load('company', 'internships');
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
        $this->authorize('update', $request);
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
        $this->authorize('delete', $companyPerson);
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
