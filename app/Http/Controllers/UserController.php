<?php
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tickets;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\LoginRequest;
use App\Repositories\UsersRepository;

class UserController extends Controller
{

    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }
    /**
     * Registra un usuario
     *
     * @param Request $request
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function register(CreateRequest $request)
    {

        $user = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password
        ];

        $role = 'ROLE_USER';

        $isset_user = $this->usersRepository->isset_user($request->email);

        if(is_null($isset_user)){

            //Crear el usuario
            $this->usersRepository->registerUser($request->email,
                                                 $request->name,
                                                 $request->surname,
                                                 $role,
                                                 $request->password);

            $data = array(
                'status' => 'success',
                'code' => 200,
                'message' => 'Usuario registrado correctamente'
            );
        }

        return response()->json($data, 200);
    }

    /**
     * Validacion de de usuario, obtener token
     *
     * @param Request $request
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function login(LoginRequest $request)
    {

        $userLogin = [
            'email' => $request->email,
            'password' => $request->password,
            'gettoken' => $request->gettoken
        ];

        $signup = $this->usersRepository->user_login($request->password,
                                                     $request->gettoken,
                                                     $request->email);

        return response()->json($signup, 200);

    }

    /**
     * Devuelve la lista de los usuarios
     *
     * @param Request $request
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function userAll(Request $request)
    {

        $hash = $request->header('Authorization', null);
        $data = $this->usersRepository->user_all($hash);

        return response()->json($data, 200);
    }

    /**
     * Devuelve un usuario por email
     *
     * @param Request $request
     * @param $email
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function userAllemail(Request $request, $email)
    {

        $hash = $request->header('Authorization', null);
        $data = $this->usersRepository->userAllemail($hash, $email);

        return response()->json($data, 200);
    }

    /**
     * Devuelve un usuario por ID
     *
     * @param Request $request
     * @param $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function userAllId(Request $request, $id)
    {

        $hash = $request->header('Authorization', null);
        $data = $this->usersRepository->userAllId($hash, $id);

        return response()->json($data, 200);
    }


}
