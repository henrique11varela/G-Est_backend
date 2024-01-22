<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyAddressRequest;
use App\Http\Requests\UpdateCompanyAddressRequest;
use App\Models\CompanyAddress;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $companyAddressesQuery = CompanyAddress::with('company');
            if (request()->has("company_id") && request()->company_id != "") {
                $companyAddressesQuery->where("company_id", "=", request()->company_id);
            }
            if (request()->has("description") && request()->description != "") {
                $companyAddressesQuery->where("description", "like", "%" . request()->description . "%");
            }
            if (request()->has("address") && request()->address != "") {
                $companyAddressesQuery->where("address", "like", "%" . request()->address . "%");
            }

            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $companyAddresses = $companyAddressesQuery\->paginate($quantity);
            return response()->json($companyAddresses, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyAddressRequest $request)
    {
        try {
            $companyAddress = new CompanyAddress();
            $companyAddress->name = $request->name;
            $companyAddress->address = $request->address;
            $companyAddress->company_id = $request->company_id;

            $companyAddress->save();
            return response()->json($companyAddress, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyAddress $company)
    {
        $company->load('companyPeople');
        try {
            return response()->json($company, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyAddressRequest $request, CompanyAddress $companyAddress)
    {
        try {
            $companyAddress->name = $request->name;
            $companyAddress->address = $request->address;
            $companyAddress->company_id = $request->company_id;
            $companyAddress->update();
            return response()->json($companyAddress, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyAddress $companyAddress)
    {
        try {
            $companyAddress->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
