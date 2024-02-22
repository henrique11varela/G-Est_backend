<?php

namespace App\Http\Controllers;


use App\Exports\StudentCollectionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StudentCollection;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ExportController extends Controller
{
    public function studentCollection(studentCollection $studentCollection)
    {
        $studentCollection->load(
            [
                'coordinator',
                'course',
                'students.internships' => function (Builder $query) use ($studentCollection) {
                    $query->where('student_collection_id', $studentCollection->id);
                },
                'students.internships.companies',
                'students.internships.startedInternship',
                'students.internships.startedInternship.companyAddress.company',
                'students.internships.startedInternship.companyPerson',
                'students.internships.endedInternship'
            ]
        );
        return Excel::download(new StudentCollectionExport($studentCollection), 'studentcollection.xlsx');
    }
}
