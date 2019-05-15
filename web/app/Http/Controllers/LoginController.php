<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;

class LoginController extends Controller
{
	public function authenticate(Request $request){
		$email = $request->Email;
		$password = $request->Password;
		if ($email == "" || $password == ""){
			return redirect('/login')->with('danger', 'Por favor ingrese su correo y clave.');
		}
		$authentication = false;
		$apellidos = "";
		$nombres = "";
		$rut = "";
		$org = "";
		$sede = "";
		$status = "";
		$anoIngreso = "";
		$grupo = "";
		$tipoProfe = "";
		$profesor = false;
		$ldapconn = ldap_connect("10.2.1.213") or die("Could not connect to LDAP server.");
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		if (Str::endsWith($email, 'uai.cl')){
			//Interno (Profesor, alumno o funcionario). Asumiremos profesor o funcionario.
			$ldaptree = "OU=UAI,DC=uai,DC=cl";
  		$usefulinfo = array("ou", "sn", "givenname", "mail", "employeeid", "distinguishedname");
			if (Str::endsWith($email, 'alumnos.uai.cl')){
				//Es un alumno. Cambiamos arbol LDAP.
				$ldaptree = "OU=Live@Edu,DC=uai,DC=cl";
	  		$usefulinfo = array("ou", "sn", "givenname", "mail", "employeeid", "distinguishedname");
			}
			else {
			}
			if ($ldapconn) {
				$ldapbind = @ldap_bind($ldapconn, $email, $password);
				if ($ldapbind) {
					$result = @ldap_search($ldapconn, $ldaptree, "(mail=".$email.")", $usefulinfo);
					$data = @ldap_get_entries($ldapconn, $result);
					$apellidos = $data[0]['sn'][0];
					$splitApellidos = explode(' ', $apellidos, 2);
					$apellidoPaterno = $splitApellidos[0];
					$apellidoMaterno = $splitApellidos[1];
					$nombres = $data[0]['givenname'][0];
					$email = $data[0]['mail'][0];
					$rut = $data[0]['employeeid'][0];
					$org = $data[0]['distinguishedname'][0];
					$org = str_replace("OU=","",$org);
					$org = str_replace("CN=","",$org);
					$org = str_replace("DC=","",$org);
					$org_arr = explode (",", $org);
					if (Str::contains($email,'alumnos.uai.cl')!= false){
						$sede = $org_arr[1];
						$status = $org_arr[2];
						$anoIngreso = $org_arr[3];
						$grupo = $org_arr[4];
						$located = User::where('email', $email) -> first();
						if ($located == ""){
							$user = User::create([
								'nombres' => $nombres,
								'apellidoPaterno' => $apellidoPaterno,
								'apellidoMaterno' => $apellidoMaterno,
								'rut' => $rut,
								'idCarrera'=> 0,
								'statusPregrado' => 0,
								'statusOmega' => 0,
								'statusWebcursos'=> 0,
								'rol' => 1,
								'email' => $email,
								'password' => 'INTUAI'
							]);
							Auth::login($user);
							return redirect('/');
						}
						else {
							echo "Alumno existe en sistema pasantías. Logeando.</br>";
							$userID = $located['idUsuario'];
							Auth::loginUsingId($userID);
							return redirect('/');
						}
					}
					else {
						$tipoProfe = $org_arr[1];
						$sede = $org_arr[2];
						$profesor = true;
						echo "Tipo de profe: " . $tipoProfe . "</br>";
						echo "Sede: " . $sede . "</br>";
						echo "Nombres: " . $nombres . "</br>";
						echo "Apellidos: " . $apellidoMaterno . " " . $apellidoPaterno . "</br>";
						echo "Email: " . $email . "</br>";
						echo "RUT: " . $rut . "</br>";

					}
				}
				else {
					return redirect('/login')->with('danger', 'Credenciales incorrectas.');
				}
			}
		}
		else {
			//Externo (Empresa)
		};
	}

	public function logout(){
		Auth::logout();
		return redirect('/login');
	}
}
