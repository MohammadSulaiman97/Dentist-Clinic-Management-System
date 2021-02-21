<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Invoice::all();
        return Invoice::select('type_treatment', 'invoice_Date', 'patient_id','Total', 'Status','note', 'Payment_Date')->get();
    }

    public function headings(): array
    {
        return [
            'type_treatment', 'invoice_Date', 'patient_id','Total', 'Status','note', 'Payment_Date'
        ];
    }
}
