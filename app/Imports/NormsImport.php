<?php

namespace App\Imports;

use App\Models\Norm;
use App\Models\Authority;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class NormsImport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $authority = Authority::where('Name', $row[5])->first();
        //dd($authority->IdAuthority);
        //dd(PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
        $dateExpedition = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
        //dd($date->format('Y-m-d'));
        //dd($row[7]);
        if (isset($row[7])) {
            $dateNotification = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]));
        }

        return new Norm([
            'IdAuthorityApprove' => $authority->IdAuthority,
            'IdState' => 1,
            'CodeNorm' => $row[0],
            'ApplicableStandard' => $row[1],
            'ShortName' => $row[2],
            'LargeName' => $row[3],
            'PlaceApplication' => $row[4],
            'ExpeditionDate' => $dateExpedition->format('Y-m-d'),
            'NotificationDate' => isset($row[7]) ? $dateNotification->format('Y-m-d') : null,
            'UserCreated' => 'OLANDA',
            'DateCreated' => Carbon::now()
        ]);
    }
}
