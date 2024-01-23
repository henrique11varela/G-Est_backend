<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $companiesQuery = Company::with('companyPeople', 'contactPeople', 'tutorPeople', 'companyAddresses');
            // if (request()->has("id")) {
            //     $companiesQuery->where("id", "like", request()->id);
            // }
            if (request()->has("name") && request()->name != "") {
                $companiesQuery->where("name", "like", "%" . request()->name . "%");
            }
            if (request()->has("niss") && request()->niss != "") {
                $companiesQuery->where("niss", "like", "%" . request()->niss . "%");
            }
            if (request()->has("nipc") && request()->nipc != "") {
                $companiesQuery->where("nipc", "like", "%" . request()->nipc . "%");
            }

            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $companies = $companiesQuery->paginate($quantity);
            return response()->json($companies, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            $company = new Company();
            $company->name = $request->name;
            $company->niss = $request->niss;
            $company->nipc = $request->nipc;

            $company->save();
            return response()->json($company, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load('companyPeople', 'companyAddresses');
        try {
            return response()->json($company, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        try {
            $company->name = $request->name;
            $company->niss = $request->niss;
            $company->nipc = $request->nipc;
            $company->update();
            return response()->json($company, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
