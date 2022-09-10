<?php

namespace App\Imports;

use App\Agreement;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class AgreementImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Agreement([
            'section'     => Agreement::where('id_user',User::where('mobile',$row[0])->first()->id)->count()+1,
            'id_user'     => User::where('mobile',$row[0])->first()->id,
            'kind'     => $row[1],
            'date'    => $row[2], 
            'bank'    => $row[3], 
            'check'    => $row[4], 
            'price'    => $row[5], 
        ]);
    }
}
