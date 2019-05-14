<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmpresaTableSeeder extends Seeder{
  public function run(){
		DB::table('empresa')->insert([
			['nombre'=>'TestEmpresa', 'rubro'=>'TestRubro', 'urlWeb'=>'http://TestURL.com', 'correoContacto'=>'testEmail@TestURL.com', 'status'=>'1', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]
		]);
  }
}
