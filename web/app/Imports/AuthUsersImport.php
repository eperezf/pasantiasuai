<?php

namespace App\Imports;

use App\AuthUsers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuthUsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AuthUsers([
            'email'=> $row['email'],
						'tipo'=>$row['tipo']
        ]);
    }
}
