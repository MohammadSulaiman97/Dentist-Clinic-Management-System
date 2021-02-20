<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.patients',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.add_patient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'career' => 'required',
            'gender' => 'required',
            'social_status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']       = $request->name;
        $data['dob']      = $request->dob;
        $data['mobile']     = $request->mobile;
        $data['address']      = $request->address;
        $data['career']    = $request->career;
        $data['gender']     = $request->gender;
        $data['social_status']      = $request->social_status;
        $data['note']    = $request->note;

        Patient::create($data);



        session()->flash('Add', 'تم اضافة المريض بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($patient)
    {

        $patients = Patient::where('id',$patient)->first();
        $patient_id = Invoice::where('patient_id',$patient)->get();

        return view('patients.show_patient',compact('patients','patient_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($patient)
    {
        $patients = Patient::where('id',$patient)->first();
        return view('patients.edit_patient',compact('patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $patient)
    {

        $patients = Patient::findOrFail($patient);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'career' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']       = $request->name;
        $data['mobile']     = $request->mobile;
        $data['address']      = $request->address;
        $data['career']    = $request->career;
        $data['note']    = $request->note;

        $patients->update($data);

        session()->flash('Edit', 'تم تعديل المريض بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->patient_id;
        Patient::where('id',$id)->delete();

        session()->flash('Delete', 'تم حذف المريض بنجاح');
        return redirect()->route('patient.index');
    }

    public function export()
    {
        return Excel::download(new PatientsExport, 'Patient.xlsx');
    }
    
}
