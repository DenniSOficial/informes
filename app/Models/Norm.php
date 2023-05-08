<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norm extends Model
{
    //use HasFactory;
    protected $table = 'norm';
    protected $primaryKey = 'IdNorm';

    protected $fillable = [
        'IdAuthorityApprove',
        'IdState',
        'CodeNorm',
        'ApplicableStandard',
        'ShortName',
        'LargeName',
        'PlaceApplication',
        'ExpeditionDate',
        'NotificationDate',
        'Url',
        'UserCreated',
        'DateCreated',
        'UserUpdated',
        'DateUpdated'
    ];

    public $timestamps = false;

    public function authority() {
        return $this->belongsTo('App\Models\Authority', 'IdAuthorityApprove');
    }

}
