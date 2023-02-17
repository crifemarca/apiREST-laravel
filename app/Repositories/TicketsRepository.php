<?php
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */
namespace App\Repositories;

use App\Models\Tickets;

class TicketsRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Tickets();
    }

    /**
     * Devuelve el listado de los registros de tickets
     *
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function all()
    {
        $tickets = Tickets::all()->load('user');
        return $tickets;
    }

    /**
     * Devuelve el detalle de un ticket
     *
     * @param string $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function show($id)
    {
        $tickets = Tickets::find($id)->load('user');
        return $tickets;
    }

    /**
     * Devuelve el ticket si existe
     *
     * @param string $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function find($id)
    {
        $tickets = Tickets::find($id)->load('user');
        return $tickets;
    }

    /**
     * Registra un ticket
     *
     * @param string $id
     * @param string $title
     * @param string $description
     * @param string $status
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function store($id, $title, $description, $status)
    {

        $tickets = new Tickets();

        $tickets->user_id = $id;
        $tickets->title = $title;
        $tickets->description = $description;
        $tickets->status = $status;

        $tickets->save();
        return $tickets;

    }

    /**
     * Actualiza un ticket
     *
     * @param string $user_id
     * @param string $title
     * @param string $description
     * @param string $status
     * @param string $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function update($user_id, $title, $description, $status, $id)
    {

        $tickets = Tickets::where('id', $id)->update(["title" => $title,
                                                        "description" => $description,
                                                        "status" => $status,
                                                        "user_id" => $user_id]);
        return $tickets;

    }

    /**
     * Elimina un ticket
     *
     * @param int $id
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function deleteTicket($id)
    {

        $tickets = new Tickets();
        $tickets->id = $id;
        $tickets->delete();

        return $tickets;

    }

}
