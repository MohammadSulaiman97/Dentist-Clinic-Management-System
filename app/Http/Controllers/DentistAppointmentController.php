<?php

namespace App\Http\Controllers;

use App\Models\Dentist_appointment;
use App\Models\Patient;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

class DentistAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Dentist_appointments = Dentist_appointment::all();
        $patients = Patient::all();
        return view('DentistAppointments.Dentist_appointments',compact('Dentist_appointments','patients'));
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
        try {
            $data['patient_Name'] = $request->patient_Name;
            $data['patient_Mobile'] = $request->patient_Mobile;
            $data['patient_Date'] = $request->patient_Date;
            $data['patient_Time'] = $request->patient_Time;
            $data['patient_id'] = $request->patient_id;

            Dentist_appointment::create($data);
            session()->flash('add','تم اضافة الموعد بنجاح');
            return redirect()->route('DentistAppointments.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dentist_appointment  $dentist_appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Dentist_appointment $dentist_appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dentist_appointment  $dentist_appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Dentist_appointment $dentist_appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dentist_appointment  $dentist_appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{

            $dentist = Dentist_appointment::findOrFail($request->id);

            $data['patient_Name'] = $request->patient_Name;
            $data['patient_Mobile'] = $request->patient_Mobile;
            $data['patient_Date'] = $request->patient_Date;
            $data['patient_Time'] = $request->patient_Time;
            $data['patient_id'] = $request->patient_id;

            $dentist->update($data);
            session()->flash('edit','تم تعديل الموعد بنجاح');
            return redirect()->route('DentistAppointments.index');

        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dentist_appointment  $dentist_appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Dentist_appointment = Dentist_appointment::findOrFail($request->id);

        $id_page = $request->id_page;

        if ($id_page == -1){
            $Dentist_appointment->Delete();
            session()->flash('archive','تم اكمال الموعد بنجاح');
            return redirect()->route('DentistAppointments.index');
        }else{
            $Dentist_appointment->forceDelete();
            session()->flash('delete','تم حذف الموعد بنجاح');
            return redirect()->route('DentistAppointments.index');
        }

    }
}
