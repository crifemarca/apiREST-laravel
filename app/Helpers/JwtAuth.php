<?php
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */
namespace App\Helpers;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'esta-es-mi-clave-secreta-55787656789087';
    }

    /**
     * Valida usuario y genera token,
     * devuleve usuario cifrado (token) / Informacion de usuario
     *
     * @param string $email
     * @param string $password
     * @param string $getToken
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function signup($email, $password, $getToken = null){

        $user = User::where(
            array(
                'email' => $email,
                'password' => $password
            ))->first();

        $signup  = false;

        if(is_object($user)){
            $signup = true;
        }

        if($signup){

            //Gnerar el token y devolverlo
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'iat' => time(),
                'exp' => time() + (60 *60 * 12) // + (7 * 24 * 60 * 60)
            );

            $jwt =  JWT::encode($token, $this->key, 'HS256');

            $decode = JWT::decode($jwt, $this->key, array(
                'HS256'
            ));

            if(is_null($getToken)){
                return $jwt;
            }else{
                return $decode;
            }

        }else{
            //Devolver error
            return 'error';
        }

    }

    /**
     * Valida la informacion del token
     *
     * @param string $jwt
     * @param boolean $getIdentity
     * @autor Christian Felipe Martinez Castaño
     *
     */

    public function checkToken($jwt, $getIdentity = false){

        $auth = false;

        try {

            $decode = JWT::decode($jwt, $this->key, array('HS256'));

        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $e) {
            $auth = false;
        }

        if(isset($decode) && is_object($decode) && isset($decode->sub)){
            $auth = true;
        }else{
            $auth = false;
        }

        if($getIdentity){
            return $decode;
        }

        return $auth;

    }

}
