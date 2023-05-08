<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    //use HasFactory;

    protected $table = 'phase';
    protected $primaryKey = 'IdPhase';

    protected $fillable = [
        'IdState',
        'Name'
    ];

    public $timestamps = false;
}
