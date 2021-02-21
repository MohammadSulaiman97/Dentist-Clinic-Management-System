<?php

namespace App\Http\Controllers;

use App\Models\Dentist_appointment;
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
        return view('DentistAppointments.Dentist_appointments');
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
    public function update(Request $request, Dentist_appointment $dentist_appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dentist_appointment  $dentist_appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dentist_appointment $dentist_appointment)
    {
        //
    }
}
