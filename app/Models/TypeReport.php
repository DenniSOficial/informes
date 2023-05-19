<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeReport extends Model
{
    //use HasFactory;
    protected $table = 'typereports';
    protected $primaryKey = 'IdTypeReport';

    protected $fillable = [
        'IdState',
        'Description'
    ];

    public $timestamps = false;
}
