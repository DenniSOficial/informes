<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCommitment extends Model
{
    //use HasFactory;

    protected $table = 'reports_commitment';
    protected $primaryKey = 'IdReportCommitment';

    protected $fillable = [
        'IdReport',
        'IdCommitment',
        'IdState'
    ];

    public $timestamps = false;

}
