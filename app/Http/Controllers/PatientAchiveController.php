<?php

namespace App\Http\Controllers;

use App\Models\Dentist_appointment;
use Illuminate\Http\Request;

class PatientAchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Dentist_appointments = Dentist_appointment::onlyTrashed()->get();
        return view('DentistAppointments.Archive_Patients',compact('Dentist_appointments'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $restore = Dentist_appointment::withTrashed()->where('id', $request->id)->restore();
        session()->flash('restore_patient','تم استعادة موعد المريض بنجاح');
        return redirect('/DentistAppointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $delete = Dentist_appointment::withTrashed()->where('id', $request->id)->first();
       $delete->forceDelete();
        session()->flash('delete_patient','تم حذف المريض بنجاح');
        return redirect('/Archive');
    }
}
