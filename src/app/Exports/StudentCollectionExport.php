<?php

namespace App\Exports;

use App\Models\StudentCollection;
use App\Models\Student;
use App\Models\StartedInternship;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentCollectionExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $studentCollection;

    public function __construct(StudentCollection $studentCollection)
    {
        $this->studentCollection = $studentCollection;
    }

    public function headings(): array
    {
        return [
            'Curso',
            'Turma',
            'Nome Completo do Formando (1)',
            'Nome Completo do Formando (2)',
            'Data de Inicio do Estágio',
            'Data Final do Estágio',
            'Duração',
            'Designação Empresa',
            'Tutor do Formando na Empresa',
            'Contacto telefónico do Tutor',
            'Contacto eletrónico do Tutor',
            'Coordenador do Curso',
            'Contacto telefónico do Coordenador',
            'Email Coordenador',
            'Assinatura ATEC (1)',
            'Assinatura ATEC (2)',
            'Representante Legal do Formando (quando menor)',
            'Alimentação',
            'Responsável Acordo Parceria',
            'Cargo do Responsável do Acordo de Parceria',
            'Morada da Sede',
            'Código Postal',
            'Localidade',
            'CAE',
            'NISS',
            'NIPC',
            'Morada do Estágio (quando diferente da sede)',
            'Código Postal(2)',
            'Localidade(2)',
            'Envio de documentação a:',
            'Morada de envio:',
            'Nome e Apelido',
            'Email live edu',
            'Telemovel',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'argb' => 'FFFFFF'
                        ]
                    ],
                'size' => 12,
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => '8497b0',
                    ],
                ]
            ],
        ];
    }

    public function array(): array
    {
        $export = [];
        foreach ($this->studentCollection->students as $student) {
            $internship = $student->internships->last();
            $startedInternship = $internship?->startedInternship;
            $company = $internship?->companies()->where('status', 'aceite')->first();
            $hq = $company?->companyAddresses()->where('hq', 1)->first();

            array_push($export, [
                //Curso
                $this->studentCollection->course->name,
                //Turma
                $this->studentCollection->name,
                //Nome Completo do Formando (1)
                $student->name,
                //Nome Completo do Formando (2)
                null,
                //Data de Inicio do Estágio
                $startedInternship?->start_date,
                //Data Final do Estágio
                $startedInternship?->end_date,
                //Duração
                /*$startedIntership?->hourly_load,*/ null,
                //Designação Empresa
                $company?->name,
                //Tutor do Formando na Empresa
                $startedInternship?->companyPerson?->name,
                //Contacto telefónico do Tutor
                $startedInternship?->companyPerson?->phone_number,
                //Contacto eletrónico do Tutor
                $startedInternship?->companyPerson?->email,
                //Coordenador do Curso
                $this->studentCollection->coordinator?->name,
                //Contacto telefónico do Coordenador
                $this->studentCollection->coordinator?->phone_number,
                //Email Coordenador
                $this->studentCollection->coordinator?->email_atec,
                /*Assinatura ATEC (1)',
                'Assinatura ATEC (2)',
                'Representante Legal do Formando (quando menor)',*/
                null, null, null,
                //Alimentação
                isset($startedInternship) ? ($startedInternship->meal_allowance == 1 ? 'Sim' : 'Não') : null,
                /*'Responsável Acordo Parceria',
                'Cargo do Responsável do Acordo de Parceria',*/
                null, null,
                //Morada da Sede
                $hq?->address,
                //Código Postal
                $hq?->postal_code,
                //Localidade
                /*$hq?->locality*/ null,
                //CAE
                $startedInternship?->company?->cae,
                //NISS
                $startedInternship?->company?->niss,
                //NIPC
                $startedInternship?->company?->nipc,
                //Morada do Estágio (quando diferente da sede)
                $hq?->hq == 1 ? null :  $startedInternship?->companyAddress->address,
                //Código Postal(2)
                $hq?->hq == 1 ? null :  $startedInternship?->companyAddress->postal_code,
                //Localidade(2)
                /*$hq?->hq == 1 ? null :  $startedInternship?->companyAddress->locality,*/ null,
                //Envio de documentação a:
                null,
                //Morada de envio:
                /*morada de envio sede ou estágio? falta implementar inquirir*/ null,
                //Nome e Apelido
                null,
                //Email live edu
                $student->atec_email,
                //Telemovel
                $student->phone_number,
            ]);
        }
        return $export;
    }
}
