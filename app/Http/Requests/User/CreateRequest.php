<?php
/**
 *
 * @autor Christian Felipe Martinez Castaño
 * 2023
 *
 */

namespace App\Http\Requests\User;

use App\Model\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:5',
            'surname' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
}

