<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    function __construct($id_paye)
    {
        $this->id_paye = $id_paye;
    }
    public function model(array $row)
    {
        return new User([
            'fname'     => $row[0],
            'lname'     => $row[1],
            'f_name'     => $row[2],
            'mobile'    => $row[3], 
            'date'    => $row[4], 
            'f_number'    => $row[5], 
            'm_number'    => $row[6], 
            'password' => Hash::make($row[7]),
            'pass' => $row[7],
            'role' => 4,
            'id_paye' => $this->id_paye,
        ]);
    }
}
