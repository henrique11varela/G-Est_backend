<?php

namespace App\Http\Controllers;


use App\Exports\StudentCollectionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StudentCollection;

class ExportController extends Controller
{
    public function studentCollection(studentCollection $studentCollection)
    {
        return Excel::download(new StudentCollectionExport($studentCollection), 'studentcollection.xlsx');
    }
}
