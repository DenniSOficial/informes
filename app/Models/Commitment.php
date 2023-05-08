<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    //use HasFactory;
    protected $table = 'commitments';
    protected $primaryKey = 'IdCommitments';

    protected $fillable = [
        'IdNorm',
        'IdPhase',
        'IdFrequency',
        'IdState',
        'CodeCommitment',
        'Summary',
        'DescriptionEnvironmentalCommitment',
        'CoordinateUTM',
        'CoordinateNUTM',
        'RelatedImpact',
        'UserCreated',
        'DateCreated',
        'UserUpdated',
        'DateUpdated'
    ];

    public $timestamps = false;

    public function norm() {
        return $this->belongsTo('App\Models\Norm', 'IdNorm');
    }

    public function phase() {
        return $this->belongsTo('App\Models\Phase', 'IdPhase');
    }

    public function frequency() {
        return $this->belongsTo('App\Models\Frequency', 'IdFrequency');
    }


}
