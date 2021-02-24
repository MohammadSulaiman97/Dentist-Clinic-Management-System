<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Nicolaslopezj\Searchable\SearchableTrait;

class Patient extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $fillable = ['name','dob','mobile','address','career','gender','social_status','note'];


    protected $searchable = [
        'columns' => [
            'patients.name' => 10,
            'patients.address' => 10,
        ],
    ];

}
