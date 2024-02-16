<?php

namespace App\Imports;

use App\Models\StudentCollection;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentCollectionsImport implements ToCollection, WithHeadingRow
{
    public static $studentCollectionsHeadings = ['turma', 'nome_formando', 'email_institucional'];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $course = Course::where('name', $row['curso'])->first();
            if (!$course) continue;

            $studentCollection = StudentCollection::updateOrCreate(
                ['name' => $row['turma']],
                ['course_id' => $course->id]
            );

            if ($row['situacao_na_turma'] !== 'em formação') continue;

            $student = Student::updateOrCreate(
                [
                    'atec_email' => $row['email_institucional']
                ],
                [
                    'name' => $row['nome_formando'],
                    'personal_email' => $row['email'],
                    'phone_number' => $row['telemovel'],
                    'address' => $row['morada'],
                    'postal_code' => $row['codigo_postal'],
                    'locality' => $row['localidade_postal'],
                ]
            );

            $studentCollection->students()->syncWithoutDetaching([$student->id]);
        }
    }
}
