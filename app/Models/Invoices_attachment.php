<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'patient_name',
        'Created_by',
        'invoice_id'
    ];
}
