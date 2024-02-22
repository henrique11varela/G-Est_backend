<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyAddressRequest;
use App\Http\Requests\UpdateCompanyAddressRequest;
use App\Models\Company;
use App\Models\CompanyAddress;

class CompanyAddressController extends Controller
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
            $companyAddresses = $companyAddressesQuery->paginate($quantity);
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
        $this->authorize('create', CompanyAddress::class);
        try {
            $companyAddress = new CompanyAddress();
            $companyAddress->description = $request->description;
            $companyAddress->address = $request->address;
            $companyAddress->company_id = $request->company_id;
            $companyAddress->locality = $request->locality;
            $companyAddress->hq = $request->hq;
            if ($request->hq) {
                CompanyAddress::where('company_id', '=', $request->company_id)->update([
                    'hq' => false
                ]);
            }
            $companyAddress->postal_code = $request->postal_code;
            $companyAddress->save();
            return response()->json($companyAddress, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyAddress $companyAddress)
    {
        try {
            return response()->json($companyAddress, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyAddressRequest $request, CompanyAddress $companyAddress)
    {
        $this->authorize('update', $request);
        try {
            $companyAddress->description = $request->description;
            $companyAddress->address = $request->address;
            $companyAddress->address = $request->address;
            $companyAddress->postal_code = $request->postal_code;
            $companyAddress->hq = $request->hq;
            $companyAddress->locality = $request->locality;
            if ($request->hq) {
                CompanyAddress::where('company_id', '=', $request->company_id)->update([
                    'hq' => false
                ]);
            }
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
        $this->authorize('delete', $companyAddress);
        try {
            $companyAddress->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
