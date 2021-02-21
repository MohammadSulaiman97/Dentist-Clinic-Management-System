<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dentist_appointment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'patient_Name',
        'patient_Mobile',
        'patient_Date',
        'patient_Time',
        'patient_id'
    ];

    protected $dates = ['deleted_at'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
