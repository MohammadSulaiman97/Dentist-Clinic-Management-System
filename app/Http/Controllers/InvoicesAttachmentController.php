<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoices_attachment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',

        ], [
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);

        $patient_names = Invoice::with(['patient'])->where('id',$request->invoice_id)->pluck('patient_id');

        $patient_name = Patient::where('id',$patient_names)->first();


        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments = new Invoices_attachment();
        $attachments->file_name = $file_name;
        $attachments->Created_by = (Auth::user()->name);
        $attachments->invoice_id = $request->invoice_id;
        $attachments->patient_name = $patient_name->name;
        $attachments->save();

        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'. $patient_name->name), $imageName);

        session()->flash('Add', 'تم اضافة المرفق بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_attachment $invoices_attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_attachment $invoices_attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_attachment $invoices_attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_attachment  $invoices_attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices_attachment $invoices_attachment)
    {
        //
    }
}
