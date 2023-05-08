<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    //use HasFactory;
    protected $table = 'frequency';
    protected $primaryKey = 'IdFrequency';

    protected $fillable = [
        'IdState',
        'Name'
    ];

    public $timestamps = false;
}
