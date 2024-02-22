<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEndedInternshipRequest;
use App\Http\Requests\UpdateEndedInternshipRequest;
use App\Models\EndedInternship;

class EndedInternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $endedInternshipsQuery = EndedInternship::with("internship")->select("*");
            // if (request()->has("id")) {
            //     $internshipsQuery->where("id", "=", request()->id);
            // }
            if (request()->has("reason") && request()->reason != "") {
                $endedInternshipsQuery->where("reason", "like", "%" . request()->reason . "%");
            }
            if (request()->has("situacao_prof") && request()->situacao_prof != "") {
                $endedInternshipsQuery->where("situacao_prof", "like", "%" . request()->situacao_prof . "%");
            }
            if (request()->has("como_obteve_emprego") && request()->como_obteve_emprego != "") {
                $endedInternshipsQuery->where("como_obteve_emprego", "like", "%" . request()->como_obteve_emprego . "%");
            }

            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $endedInternships = $endedInternshipsQuery->paginate($quantity);
            return response()->json($endedInternships, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEndedInternshipRequest $request)
    {
        $this->authorize('create', $request);
        try {
            $endedInternship = new EndedInternship();
            $endedInternship->internship_id = $request->internship_id;
            $endedInternship->reason = $request->reason;
            $endedInternship->end_date = $request->end_date;
            if ($request->has('is_working_there') && $request->is_working_there != "") {
                $endedInternship->is_working_there = $request->is_working_there;
            }
            $endedInternship->save();
            return response()->json($endedInternship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EndedInternship $endedInternship)
    {
        try {
            $endedInternship = $endedInternship->load("internship");
            return response()->json($endedInternship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEndedInternshipRequest $request, EndedInternship $endedInternship)
    {
        $this->authorize('update', $request);
        try {
            // $endedInternship->internship_id = $request->internship_id;
            $endedInternship->reason = $request->reason;
            $endedInternship->end_date = $request->end_date;
            if ($request->has('is_working_there') && $request->is_working_there != "") {
                $endedInternship->is_working_there = $request->is_working_there;
            }
            $endedInternship->save();
            return response()->json($endedInternship, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EndedInternship $endedInternship)
    {
        $this->authorize('destroy', $endedInternship);
        try {
            $endedInternship->delete();
            return response()->json(array('success' => 'Delete success'), 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
