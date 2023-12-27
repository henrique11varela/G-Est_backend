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
            return response()->json($studentCollections, 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'failed:'.$e], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentCollectionRequest $request)
    {
        try
        {
            $studentCollections = new StudentCollection();
            $studentCollections->student_id = $request->student_id;
            $studentCollections->student_collection_id = $request->student_collection_id;
            $studentCollections->save();
            return response()->json($studentCollections, 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'failed:'.$e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentCollection $studentCollection)
    {
        try
        {
            return response()->json($studentCollection, 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'failed:'.$e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentCollectionRequest $request, StudentCollection $studentCollection)
    {
        try
        {
            $studentCollections->student_id = $request->student_id;
            $studentCollections->student_collection_id = $request->student_collection_id;
            $studentCollections->save();
            return response()->json($studentCollection, 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'failed:'.$e], 500);
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
            return response()->json(['message' => 'Student Collection deleted'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'failed:'.$e], 500);
        }
    }
}
