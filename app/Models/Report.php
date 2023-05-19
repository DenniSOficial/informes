<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //use HasFactory;
    protected $table = 'reports';
    protected $primaryKey = 'IdReport';

    protected $fillable = [
        'IdReportManager',
        'IdReportStatus',
        'IdTypeReport',
        'IdState',
        'IdClient',
        'BusinessName',
        'BusinessExecutiveCode',
        'BusinessExecutive',
        'QuoteNumber',
        'ToName',
        'Expedition',
        'Notification'
    ];

    public $timestamps = false;

    public function manager() {
        return $this->belongsTo('App\Models\ReportManager', 'IdReportManager');
    }

    public function type() {
        return $this->belongsTo('App\Models\TypeReport', 'IdTypeReport');
    }
}
