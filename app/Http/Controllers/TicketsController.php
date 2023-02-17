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
use App\Models\Tickets;
use App\Http\Requests\Tickets\StorageTicket;
use App\Http\Requests\Tickets\UpdateTicket;
use App\Repositories\TicketsRepository;


class TicketsController extends Controller
{

    private $ticketsRepository;

    public function __construct(ticketsRepository $ticketsRepository)
    {
        $this->ticketsRepository = $ticketsRepository;
    }

    /**
     * Devuelve el listado de los registros de ticketss
     *
     * @param Request $request
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function index(Request $request)
    {

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        //valida token
        if($checkToken){

            $tickets = $this->ticketsRepository->all();

            return response()->json(array(
                'tickets' => $tickets,
                'status' => 'success'
            ), 200);

        }else{
            //devolver un error
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 300
            );
        }
        return response()->json($data, 200);
    }

    /**
     * Devuelve el detalle de un tickets
     *
     * @param Request $request
     * @param int $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function show(Request $request, $id)
    {

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){

            $tickets = $this->ticketsRepository->find($id);

            if(is_object($tickets)){

                $tickets = $this->ticketsRepository->show($id);

                $data = array(
                    'tickets' => $tickets,
                    'status' => 'success',
                    'code' => 200
                );

            }else{
                $data = array(
                    'menssage' => 'no existe el ID del tickets',
                    'status' => 'error',
                    'code' => 300
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
        return response()->json($data, 200);
    }

    /**
     * Registra un tickets
     *
     * @param Request $request
     * @autor Christian Felipe Martinez Castaño
     *
     */
     public function store(StorageTicket $request)
     {

        $user = [
            'title' => $request->name,
            'description' => $request->surname,
            'status' => $request->password
        ];

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){

            //guardar el tickets
            $tickets = $this->ticketsRepository->store($request->user_id,
                                                        $request->title,
                                                        $request->description,
                                                        $request->status);

             $data = array(
                 'tickets' => $tickets,
                 'status' => 'success',
                 'code' => 200
             );

        }else{

            $data = array(
                'message' => 'Error de autenticacion',
                'status' => 'error',
                'code' => 405
            );

        }


        return response()->json($data, 200);

    }

    /**
     * Actualiza un tickets
     *
     * @param Request $request
     * @param int $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
     public function update($id, UpdateTicket $request)
     {

        $user = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ];

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){

            //Actualizar registro
            $tickets = $this->ticketsRepository->update($request->user_id,
                                                         $request->title,
                                                         $request->description,
                                                         $request->status,
                                                         $id);

            $data = array(
                'tickets' => $tickets,
                'status' => 'success',
                'code' => 200
            );

        }else{

            $data = array(
                'menssage' => 'Error de autenticacion',
                'status' => 'Error',
                'code' => 200
            );

        }

        return response()->json($data, 200);

    }

    /**
     * Elimina un tickets
     *
     * @param Request $request
     * @param int $id
     * @autor Christian Felipe Martinez Castaño
     *
     */

    public function destroy($id, Request $request){

        $hash = $request->header('Authorization', null);
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if($checkToken){

            $tickets = $this->ticketsRepository->deleteTicket($id);

            $data = array(
                'tickets' => $tickets,
                'status' => 'success',
                'code' => 200
            );

        }else{
            //devolver un error
            $data = array(
                'message' => 'Login incorrecto',
                'status' => 'error',
                'code' => 300
            );
        }
        return response()->json($data, 200);
    }

}
