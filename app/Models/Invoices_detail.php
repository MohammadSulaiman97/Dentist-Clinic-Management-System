<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_Invoice',
        'type_treatment',
        'Status',
        'Value_Status',
        'note',
        'patient',
        'Payment_Date',
    ];
}
