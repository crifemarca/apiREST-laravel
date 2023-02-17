<?php
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */
namespace App\Repositories;

use App\Models\User;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\DB;

class UsersRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /*
    * Devuelve la data de un usuario si existe
    *
    * @param String $email
    * @autor Christian Felipe Martinez Castaño
    *
    */
    public function isset_user($email)
    {
        $isset_user = User::where('email', $email)->first();
        return $isset_user;
    }

    /*
     * Registra un usuario
     *
     * @param String $email
     * @param String $name
     * @param String $surname
     * @param String $role
     * @param String $password
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function registerUser($email, $name, $surname, $role, $password)
    {

        $user = new User();

        $user->email = $email;
        $user->name = $name;
        $user->surname = $surname;
        $user->role = $role;

        $pwd = hash('sha256', $password);
        $user->password = $pwd;

        $user->save();

        return $user;

    }

    /*
    * Validacion de de usuario, obtener token
    *
    * @param String password
    * @param String gettoken
    * @param String email
    * @autor Christian Felipe Martinez Castaño
    *
    */
    public function user_login($password, $gettoken, $email)
    {

        $pwd = hash('sha256', $password);
        $jwtAuth = new JwtAuth();

        if($gettoken == 'false'){

            $signup = array(
                'token' => $jwtAuth->signup($email, $pwd),
                'status' => 'success',
                'code' => 200
            );

        }else{

            $signup = array(
                'token' => $jwtAuth->signup($email, $pwd, $gettoken),
                'status' => 'success',
                'code' => 200
            );

        }

        return $signup;

    }

    /**
     * Devuelve la lista de los usuarios
     *
     * @param string $hash
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function user_all($hash)
    {
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        //valida token
        if($checkToken){

            $usersAll = User::all();

            $data = array(
                'usuarios' => $usersAll,
                'status' => 'success'
            );

        }else{
            //devolver un error
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 300
            );
        }

        return $data;

    }

    /**
     * Devuelve el usuario por email
     *
     * @param string $hash
     * @param string $email
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function userAllemail($hash, $email)
    {

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        //valida token
        if($checkToken){

            $isset_user = User::where('email', 'like', '%' . $email . '%')->get();

            if(sizeof($isset_user) == 0){

                $data = array(
                    'users' => $isset_user,
                    'status' => 'error'
                );

            }else{

                $data = array(
                    'users' => $isset_user,
                    'status' => 'success'
                );
            }

        }else{
            //devolver un error
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 300
            );
        }
        return $data;
    }


   /**
     * Devuelve el usuario por email
     *
     * @param string $hash
     * @param string $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function userAllId($hash, $id)
    {

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        //valida token
        if($checkToken){

            $isset_user = User::where('id', $id)->first();

            $data = array(
                'users' => $isset_user,
                'status' => 'success'
            );

        }else{
            //devolver un error
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 300
            );
        }
        return $data;
    }

}
