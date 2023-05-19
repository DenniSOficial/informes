<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportManager extends Model
{
    //use HasFactory;
    protected $table = 'report_manager';

    protected $primaryKey = 'IdReportManager';

    protected $fillable = [
        'IdState',
        'Document',
        'Name',
        'Lastname',
        'Lastname2'
    ];

    protected $appends = ['full_name'];
    
    public $timestamps = false;

    public function getFullNameAttribute()
    {
        return $this->Lastname . ' ' . $this->LastName2 . ' ' . $this->Name;
    }
}
