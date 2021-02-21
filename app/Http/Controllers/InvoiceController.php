<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\Invoice;
use App\Models\Invoices_attachment;
use App\Models\Invoices_detail;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::all();
        return view('invoices.add_invoice', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['type_treatment'] = $request->type_treatment;
        $data['invoice_Date'] = $request->invoice_Date;
        $data['patient_id'] = $request->patient_id;
        $data['Total'] = $request->Total;
        $data['note'] = $request->note;
        if ($request->Value_Status == 1){
            $data['Status'] = "مدفوع";
            $data['Value_Status'] = 1;
            $data['Payment_Date'] = Carbon::now()->toDateTimeString();
        }elseif($request->Value_Status == 2){
            $data['Status'] = "غير مدفوع";
            $data['Value_Status'] = 2;
        }else{
            $data['Status'] = "مدفوع جزئي";
            $data['Value_Status'] = 3;
            $data['Payment_Date'] = Carbon::now()->toDateTimeString();
        }


        Invoice::create($data);

        $invoice_id = Invoice::latest()->first()->id;


        $data['id_Invoice'] = $invoice_id;
        $data['type_treatment'] = $request->type_treatment;
        if ($request->Value_Status == 1){
            $data['Status'] = "مدفوع";
            $data['Value_Status'] = 1;
            $data['Payment_Date'] = Carbon::now()->toDateTimeString();
        }elseif($request->Value_Status == 2){
            $data['Status'] = "غير مدفوع";
            $data['Value_Status'] = 2;
        }else{
            $data['Status'] = "مدفوع جزئي";
            $data['Value_Status'] = 3;
            $data['Payment_Date'] = Carbon::now()->toDateTimeString();
        }
        $data['note'] = $request->note;

        Invoices_detail::create($data);

        if($request->hasFile('pic')){

            $invoice_id = Invoice::latest()->first()->id;

            $patient_names = Invoice::with(['patient'])->where('id',$invoice_id)->pluck('patient_id');

            $patient_name = Patient::where('id',$patient_names)->first();

            //dd($patient_name);

           /*$image = $request->file('pic');
            $file_name = $image->getClientOriginalName();*/


            $image = $request->file('pic');
            $file_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/Attachments/'.$patient_name->name);
            $image->move($destinationPath, $file_name);


            $attachments = new Invoices_attachment();
            $attachments->file_name = $file_name;
            $attachments->Created_by = (Auth::user()->name);
            $attachments->invoice_id = $invoice_id;
            $attachments->patient_name = $patient_name->name;
            $attachments->save();


            // move pic
          /* $imageName = $request->pic->getClientOriginalName();
           $request->pic->move(public_path('/Attachments/' . $patient_name->name), $imageName);*/


        }

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        return view('invoices.status_update',compact('invoices'));
    }

    public function Status_Update($id,Request $request){
        $invoices = Invoice::findOrFail($id);
        if ($request->Status == 'مدفوعة'){
            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
                'Total' => $request->Total,
            ]);
            Invoices_detail::create(
                [
                    'id_Invoice' => $request->invoice_id,
                    'type_treatment' => $request->type_treatment,
                    'Value_Status' => 1,
                    'Status' => $request->Status,
                    'note' => $request->note,
                    'Payment_Date' => $request->Payment_Date,
                ]
            );
        }
        else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
                'Total' => $request->Total,
            ]);
            Invoices_detail::create([
                'id_Invoice' => $request->invoice_id,
                'type_treatment' => $request->type_treatment,
                'Value_Status' => 3,
                'Status' => $request->Status,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        return view('invoices.edit_invoice',compact('invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $invoices = Invoice::findOrFail($id);

        $data['type_treatment'] = $request->type_treatment;
        $data['invoice_Date'] = $request->invoice_Date;
        $data['Total'] = $request->Total;
        $data['note'] = $request->note;

        $invoices->update($data);

        session()->flash('edit');
        return redirect('/invoices');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoice::where('id',$id)->first();
        $Details = Invoices_attachment::where('invoice_id',$id)->first();

            if(!(empty($Details->patient_name))){
                // Storage::disk('public_uploads')->delete($Details->invoice_number.'/'.$Details->file_name);
                Storage::disk('public_uploads')->deleteDirectory($Details->patient_name);
            }

            $invoices->Delete();
            session()->flash('delete_invoice');
            return redirect('/invoices');


    }


    public function Invoice_Paid()
    {
        $invoices = Invoice::where('Value_Status', 1)->get();
        return view('invoices.invoices_paid',compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoice::where('Value_Status',2)->get();
        return view('invoices.invoices_unpaid',compact('invoices'));
    }

    public function Invoice_Partial()
    {
        $invoices = Invoice::where('Value_Status',3)->get();
        return view('invoices.invoices_Partial',compact('invoices'));
    }

    public function Print_invoice($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.Print_invoice',compact('invoices'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
}
