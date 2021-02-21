<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class Patients_Report extends Controller
{

    public function index()
    {
        $patients = Patient::all();
        return view('reports.patients_report', compact('patients'));
    }

    public function Search_patients(Request $request)
    {

        // في حالة البحث بدون التاريخ

        if ($request->Patient && $request->start_at == '' && $request->end_at == ''){

            $invoices = Invoice::select('*')->where('patient_id','=',$request->Patient)->get();
            $patients = Patient::all();
            return view('reports.patients_report',compact('patients'))->withDetails($invoices);

        }

        // في حالة البحث بتاريخ

        else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('patient_id','=',$request->Patient)->get();
            $patients = Patient::all();
            return view('reports.patients_report',compact('patients'))->withDetails($invoices);

        }

    }

}
