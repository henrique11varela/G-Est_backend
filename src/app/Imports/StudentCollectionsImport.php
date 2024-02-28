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
    private static $headings = [
        'courseName' => 'curso',
        'studentCollectionName' => 'turma',
        'studentName' => 'nome_formando',
        'studentStatus' => 'situacao_na_turma',
        'address' => 'morada',
        'postalCode' => 'codigo_postal',
        'locality' => 'localidade_postal',
        'personalEmail' => 'email',
        'atecEmail' => 'email_institucional',
        'phoneNumber' => 'telemovel',
    ];

    public static function validateHeadings($importedHeadings) {
        try {
            $errors = [];
            foreach (self::$headings as $heading) {
                if (!in_array($heading, $importedHeadings)) {
                    array_push($errors, 'Coluna '.$heading.' é obrigatória');
                }
            }
            return $errors;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $course = Course::where('name', $row[self::$headings['courseName']])->first();
            if (!$course) continue;

            if (!isset($row[self::$headings['studentCollectionName']])) continue;

            $studentCollection = StudentCollection::updateOrCreate(
                ['name' => $row[self::$headings['studentCollectionName']]],
                ['course_id' => $course->id]
            );

            if (
                !isset($row[self::$headings['studentName']]) ||
                !isset($row[self::$headings['address']]) ||
                !isset($row[self::$headings['postalCode']]) ||
                !isset($row[self::$headings['locality']]) ||
                !isset($row[self::$headings['personalEmail']]) ||
                !isset($row[self::$headings['atecEmail']]) ||
                !isset($row[self::$headings['phoneNumber']]) ||
                $row['situacao_na_turma'] !== 'em formação'
            ) continue;

            $student = Student::updateOrCreate(
                [
                    'atec_email' => $row[self::$headings['atecEmail']]
                ],
                [
                    'name' => $row[self::$headings['studentName']],
                    'address' => $row[self::$headings['address']],
                    'postal_code' => $row[self::$headings['postalCode']],
                    'locality' => $row[self::$headings['locality']],
                    'personal_email' => $row[self::$headings['personalEmail']],
                    'phone_number' => $row[self::$headings['phoneNumber']],
                ]
            );

            $studentCollection->students()->syncWithoutDetaching([$student->id]);
        }
    }
}
