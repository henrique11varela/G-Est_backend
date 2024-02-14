<?php

namespace App\Http\Controllers;

use App\Imports\StudentCollectionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\StudentCollection;

class ImportController extends Controller
{
    public function studentCollections()
    {
        try {
            if (!request()->hasFile('file')) {
                return response()->json(["message" => "File to import is required"], 400);
            }

            Excel::import(new StudentCollectionsImport, request()->file('file'));

            return response()->json(StudentCollection::all(), 200);

        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
