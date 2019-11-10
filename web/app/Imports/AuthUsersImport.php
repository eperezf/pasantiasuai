<?php

namespace App\Imports;

use App\AuthUsers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AuthUsersImport implements ToModel, WithHeadingRow{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function model(array $row){
		$alumno = AuthUsers::where('email', $row['email'])->first();
		if ($alumno){
			echo "Alumno " . $row['email'] . " ya existe. Actualizando datos.</br>";
			$alumno->tipoMalla = $row['tipomalla'];
			$alumno->save();
		}
		else {
			return new AuthUsers([
	      'email'=> $row['email'],
				'tipoMalla'=>$row['tipomalla']
	    ]);
		}

  }
}
