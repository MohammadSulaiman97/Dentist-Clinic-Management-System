<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Patient::select('name','dob','mobile','address','career','gender','social_status','note')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'name','dob','mobile','address','career','gender','social_status','note'
        ];
    }
}
