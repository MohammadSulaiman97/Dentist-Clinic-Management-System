<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_treatment',
        'invoice_Date',
        'patient_id',
        'Total',
        'Status',
        'Value_Status',
        'note',
        'Payment_Date',
    ];

    public function patient()
    {
      return $this->belongsTo(Patient::class, 'patient_id');
    }
}
