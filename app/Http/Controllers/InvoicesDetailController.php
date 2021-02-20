<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoices_attachment;
use App\Models\Invoices_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_detail $invoices_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details = Invoices_detail::where('id_Invoice',$id)->get();
        $attachments = Invoices_attachment::where('invoice_id',$id)->get();
        return view('invoices.invoices_details',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_detail $invoices_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_detail  $invoices_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = Invoices_attachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->patient_name.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($patient_name,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($patient_name.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($patient_name,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($patient_name."/".$file_name);
        return response()->file($files);
    }
}
