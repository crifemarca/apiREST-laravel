<?php
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    /**
     * relación de muchos a muchos
     *
     * @param Request $request
     * @autor Christian Felipe Martinez Castaño
     *
     */
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
