<?php

namespace App\Imports;

use App\Models\StudentCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

class StudentCollectionsImport implements ToModel, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StudentCollection([
            'name' => $row[0],
            'course_id' => $row[1],
        ]);
    }

    /**
    * @return string|array
    */
    public function uniqueBy()
    {
        return 'name';
    }
}
