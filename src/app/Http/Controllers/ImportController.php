<?php

namespace App\Http\Controllers;

use App\Imports\StudentCollectionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\StudentCollection;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    public function studentCollections()
    {
        try {
            if (!request()->hasFile('file')) {
                return response()->json(["message" => "File to import is required"], 400);
            }

            $importedHeadings = (new HeadingRowImport)->toArray(request()->file('file'));
            $firstSheetHeadingArray = $importedHeadings[0][0];
            $errors = StudentCollectionsImport::validateHeadings($firstSheetHeadingArray);
            if ($errors === null) {
                return response()->json(["message" => "Server error processing import request"], 500);
            }
            if (count($errors) > 0) {
                return response()->json(['errors' => $errors], 400);
            }

            Excel::import(new StudentCollectionsImport, request()->file('file'));
            return response()->json(["message" => "Import successful"], 200);

        } catch (\Exception $e) {
            return response()->json(["message" => "failed:" . $e], 500);
        }
    }
}
