<?php

namespace App\Imports;

use App\Models\Commitment;
use App\Models\Norm;
use App\Models\Frequency;
use App\Models\Phase;

use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class CommitmentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $current_norm = Norm::where('CodeNorm', $row[0])->first();

        if (isset($current_norm)) {

            $current_frequency = Frequency::where('Name', $row[4])->first();

            if (!isset($current_frequency)) {
                $current_frequency = New Frequency;
                $current_frequency->IdState = 1;
                $current_frequency->Name = $row[4];
                $current_frequency->save();
            }

            $current_phase = Phase::where('Name', $row[3])->first();
            
            if (!isset($current_phase)) {
                $current_phase = New Phase;
                $current_phase->IdState = 1;
                $current_phase->Name = $row[3];
                $current_phase->save();
            }
            //dd($current_phase);
            //dd($row);

            return new Commitment([
                'IdNorm' => $current_norm->IdNorm,
                'IdPhase' => $current_phase->IdPhase,
                'IdFrequency' => $current_frequency->IdFrequency,
                'IdState' => 1,
                'CodeCommitment' => $row[1],
                'Summary' => $row[2],
                'DescriptionEnvironmentalCommitment' => $row[5],
                'CoordinateUTM' => $row[6],
                'CoordinateNUTM' => $row[7],
                'RelatedImpact' => $row[8],
                'UserCreated' => 'OLANDA',
                'DateCreated' => Carbon::now()
            ]);    
        }
        
    }
}
