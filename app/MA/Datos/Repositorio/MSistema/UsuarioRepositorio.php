<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:34 PM
 */

namespace MA\Datos\Repositorio\MSistema;


use App\User;
use Illuminate\Support\Facades\DB;

class UsuarioRepositorio
{

    public  function  ObtenerListaUsuarios($idEmpresa,$idUsuario)
    {
        $users = DB::table('users')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Empresas', 'Tbl_Empresas.id', '=', 'Tbl_Sedes.Empresa_id')
            ->join('Tbl_Roles_Por_Usuarios','Tbl_Roles_Por_Usuarios.user_id','=','users.id')
            ->join('Tbl_Roles','Tbl_Roles.id','=','Tbl_Roles_Por_Usuarios.Rol_id')
            ->select('users.*','Tbl_Roles.Nombre')
            ->where('Tbl_Empresas.id', '=', $idEmpresa)
            ->where('users.id','<>',$idUsuario)
            ->get();
        return $users;
    }
}