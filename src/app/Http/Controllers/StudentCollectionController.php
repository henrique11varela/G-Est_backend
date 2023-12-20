<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentCollectionRequest;
use App\Http\Requests\UpdateStudentCollectionRequest;
use App\Models\StudentCollection;

class StudentCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $studentCollections = StudentCollection::all();
            return response()->json(['Message' => 'List of all Students Collections'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['Message' => 'Error while getting Students Collections'], 500);
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
    public function store(StoreStudentCollectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentCollection $studentCollection)
    {
        try
        {
            return response()->json(['Message' => 'Student Collection found', 'Student Collection' => $studentCollection], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['Message' => 'Error while getting Student Collection', $e, 500]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentCollection $studentCollection)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentCollectionRequest $request, StudentCollection $studentCollection)
    {
        try
        {
            $this->validate($request, ['student_id' => 'required', 'student_collection_id' => 'required']);

            $studentCollection->student_id = $request->student_id;
            $studentCollection->student_collection_id = $request->student_collection_id;
            $studentCollection->save();

            return response()->json(['Message' => 'Student Collection updated', 'Student Collection' => $studentCollection], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['Message' => 'Error while updating Student Collection', $e, 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentCollection $studentCollection)
    {
        try
        {
            $studentCollection->delete();
            return response()->json(['Message' => 'Student Collection deleted'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['Message' => 'Error while deleting Student Collection', $e, 500]);
        }
    }
}
