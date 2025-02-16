<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller

{
    //

    public function index()
    {
        return view('login.login');
    }

    public function store()
    {

        error_reporting(0);
        $domain = 'bdp.com.bo';
        $ldaprdn  = implode(request(['user'])); // ldap rdn or dn
        $ldappass = implode(request(['password']));  // associated password



        $ldapconn = ldap_connect('10.1.6.4') or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
        if ($ldapconn) {

            $ldapbind = ldap_bind($ldapconn, $ldaprdn . '@' . $domain, $ldappass);


            if ($ldapbind) {


                $result = ldap_search($ldapconn, "dc=bdp, dc=com, dc=bo", "(samaccountname=$ldaprdn)");
                $entries = ldap_get_entries($ldapconn, $result);

                $userDN6 = $entries[0]["distinguishedname"][0];
                $separador = ",";
                $separada = explode($separador, $userDN6);
                $n = $separada[1];
                $separador2 = " ";
                $age = explode($separador2, $n);

                // obtener CN de la cadena de memberf
                $cn = $entries[0]["memberof"][0];
                $spdr = ",";
                $spd = explode($spdr, $cn);
                $m = $spd[0];
                $spdr2 = " ";

                $gr = implode(explode($spdr2, $m));
                $grp = substr($gr, 3);


                $dldap = array(
                    $userDN3 = $entries[0]["displayname"][0],       //0
                    $userDN4 = $entries[0]["samaccountname"][0],    //1
                    $userDN5 = $entries[0]["mail"][0],              //2
                    $userDN = $entries[0]["description"][0],        //3
                    $age[1],
                    $grp,
                );


                $con =  DB::select('select user from users where user = ? ', [$dldap[1]]);
               
                if ($con == null) {
                    if ($dldap[3] == 'GERENCIA DE SISTEMAS Y TECNOLOGIA DE LA INFORMACION' || 'PASANTE - GERENCIA DE SISTEMAS Y TECNOLOGIA DE LA INFORMACION') {
                        DB::insert('insert into users (name, user, email, descripcion, agencia, acceso, password) values (?,?,?,?,?,?,?)', [$dldap[0], $dldap[1], $dldap[2], $dldap[3],'central', 'yes', Hash::make($dldap[1])]);
                    } elseif ($grp == 'Operativos') {
                        DB::insert('insert into users (name, user, email, descripcion, agencia, acceso, password) values (?,?,?,?,?,?,?)', [$dldap[0], $dldap[1], $dldap[2], $dldap[3], $age[1], 'no', Hash::make($dldap[1])]);
                    }else{
                        return back()->withErrors([
                            'message' => 'El cargo no tiene acceso al sistema',
                        ]);
                    }
                }else{
                    $vn = DB::select('select user from users where user = ? and agencia = ?',[$dldap[1],$age[1]]);
                    if($vn == null){
                        $up = DB::select('update users set agencia = ? where user = ?',[$age[1],$dldap[1]]); 
                    }
                                   
                }
            } else {
                //echo "error de datos de usuario";
                return back()->withErrors([
                    'message' => 'El nombre o contraseña son incorrectos',
                ]);
            }
        } else {
            echo "Error de servidor";
        }
        if (Auth::attempt(['user' => $ldaprdn, 'password' => $dldap[1]])) {
            ldap_close($ldapconn);
            if (Auth::user()->acceso == 'yes') {
                return redirect()->to('/home');
            } else {
                return redirect()->to('/bitacora/create');
            }
        } else {
            return back()->withErrors([
                'message' => 'error en al Autenticar',
            ]);
        }
        //return view('home');
        //return view('home')->with(['dldap' => $dldap]);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->to('/login');
    }
}
