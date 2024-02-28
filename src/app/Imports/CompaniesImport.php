<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\CompanyPerson;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToCollection, WithHeadingRow
{
    private static $headings = [
        'companyName' => 'designacao_empresa',
        'cae' => 'cae',
        'niss' => 'niss',
        'nipc' => 'nipc',
        'tutorName' => 'tutor_do_formando_na_empresa',
        'tutorPhone' => 'contacto_telefonico_do_tutor',
        'tutorEmail' => 'contacto_eletronico_do_tutor',
        'addressHq' => 'morada_da_sede',
        'postalCodeHq' => 'codigo_postal',
        'localityHq' => 'localidade',
        'addressInternship' => 'morada_do_estagio_quando_diferente_da_sede',
        'postalCodeInternship' => 'codigo_postal2',
        'localityInternship' => 'localidade2',
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

    private static function setTutor(Collection $row, int $companyId) {
        if (
            !isset($row[self::$headings['tutorName']]) ||
            !isset($row[self::$headings['tutorPhone']]) ||
            !isset($row[self::$headings['tutorEmail']])
        ) return;

        $companyPerson = CompanyPerson::where('name', $row[self::$headings['tutorName']])
        ->where('phone_number', $row[self::$headings['tutorPhone']])
        ->where('email', $row[self::$headings['tutorEmail']])
        ->where('company_id', $companyId)
        ->first();

        if (!$companyPerson) {
            $companyPerson = new CompanyPerson();
            $companyPerson->is_contact = 0;
        }
        $companyPerson->name = $row[self::$headings['tutorName']];
        $companyPerson->phone_number = $row[self::$headings['tutorPhone']];
        $companyPerson->email = $row[self::$headings['tutorEmail']];
        $companyPerson->company_id = $companyId;
        $companyPerson->is_tutor = 1;
        $companyPerson->save();
    }

    private static function setHq(Collection $row, int $companyId) {
        if (
            !isset($row[self::$headings['addressHq']]) ||
            !isset($row[self::$headings['postalCodeHq']]) ||
            !isset($row[self::$headings['localityHq']])
        ) return;

        $hq = CompanyAddress::where('address', $row[self::$headings['addressHq']])
        ->where('postal_code', $row[self::$headings['postalCodeHq']])
        ->where('locality', $row[self::$headings['localityHq']])
        ->where('company_id', $companyId)
        ->first();

        if (!$hq) $hq = new CompanyAddress();
        $hq->company_id = $companyId;
        $hq->address = $row[self::$headings['addressHq']];
        $hq->postal_code = $row[self::$headings['postalCodeHq']];
        $hq->locality = $row[self::$headings['localityHq']];
        $hq->hq = 1;
        $hq->save();
    }

    private static function setIntershipAddress(Collection $row, int $companyId) {
        if (
            !isset($row[self::$headings['addressInternship']]) ||
            !isset($row[self::$headings['postalCodeInternship']]) ||
            !isset($row[self::$headings['localityInternship']])
        ) return;

        $internshipAddress = CompanyAddress::where('address', $row[self::$headings['addressInternship']])
        ->where('postal_code', $row[self::$headings['postalCodeInternship']])
        ->where('locality', $row[self::$headings['localityInternship']])
        ->where('company_id', $companyId)
        ->first();

        if (!$internshipAddress) $internshipAddress = new CompanyAddress();
        $internshipAddress->company_id = $companyId;
        $internshipAddress->address = $row[self::$headings['addressInternship']];
        $internshipAddress->postal_code = $row[self::$headings['postalCodeInternship']];
        $internshipAddress->locality = $row[self::$headings['localityInternship']];
        $internshipAddress->hq = 0;
        $internshipAddress->save();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if (!isset($row[self::$headings['companyName']])) {
                continue;
            }
            $company = Company::updateOrCreate(
                [
                    'name' => $row[self::$headings['companyName']]
                ],
                [
                    'niss' => $row[self::$headings['niss']],
                    'nipc' => $row[self::$headings['nipc']],
                    'cae' => $row[self::$headings['cae']],
                ]
            );
            if (!$company) continue;

            self::setTutor($row, $company->id);
            self::setHq($row, $company->id);
            self::setIntershipAddress($row, $company->id);
        }
    }
}
