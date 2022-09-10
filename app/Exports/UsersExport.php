<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($id_room)
    {
        $this->id_room = $id_room;
    }

    public function collection()
    {
        return User::select('fname','lname','mobile','date','f_number','m_number','p_number','tel')->where('id_room', $this->id_room)->orderby('lname',"ASC")->get();
    }
    public function headings(): array
    {
        return [
            'نام',
            'نام خانوادگی',
            'کد ملی',
            'تاریخ تولد',
            'شماره پدر',
            'شماره مادر',
            'شماره ولی پیگیر',
            'شماره منزل',
        ];
    }
}
