<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentCollectionRequest;
use App\Http\Requests\UpdateStudentCollectionRequest;
use App\Models\StudentCollection;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudentCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $studentCollectionsQuery = StudentCollection::select("*");
            // if (request()->has("id")) {
            //     $studentCollectionsQuery->where("id", "=", request()->id);
            // }
            if (request()->has("name") && request()->name != "") {
                $studentCollectionsQuery->where("name", "like", "%" . request()->name . "%");
            }
            if (request()->has("course_id") && request()->course_id != "") {
                $studentCollectionsQuery->where("course_id", "like", "%" . request()->course_id . "%");
            }
            $quantity = isset(request()->quantity) ? request()->quantity : 15;
            $studentCollections = $studentCollectionsQuery->with(['course'])->paginate($quantity);
            return response()->json($studentCollections, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentCollectionRequest $request)
    {
        try {
            $studentCollection = new StudentCollection();
            $studentCollection->name = $request->name;
            $studentCollection->course_id = $request->course_id;
            $studentCollection->save();
            $studentCollection->students()->sync($request->students);
            return response()->json($studentCollection, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentCollection $studentCollection)
    {
        try {
            $studentCollection->load(
                [
                    'course',
                    'students.internships' => function (Builder $query) use ($studentCollection) {
                        $query->where('student_collection_id', $studentCollection->id);
                    },
                    'students.internships.companies',
                    'students.internships.startedInternship',
                    'students.internships.endedInternship'
                ]
            );
            return response()->json($studentCollection, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentCollectionRequest $request, StudentCollection $studentCollection)
    {
        try {
            $studentCollection->name = $request->name;
            $studentCollection->course_id = $request->course_id;
            $studentCollection->save();
            if($request->has('students')) {
                $studentCollection->students()->sync($request->students);
            }
            return response()->json($studentCollection, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentCollection $studentCollection)
    {
        try {
            $studentCollection->delete();
            return response()->json(['message' => 'Student Collection deleted'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'failed:' . $e], 500);
        }
    }
}
