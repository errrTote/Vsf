<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class familiarRequest extends Request
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
            'first_name.*' => 'required|alpha',
            'last_name.*' => 'required|alpha',
            'relationship.*' => 'required|alpha',
            'ocupation.*' => 'required|alpha',
            'dateBirth.*' => 'required',
            'id_state.*' => 'required',
            'email.*' => 'required|email',
            'home_phone.*' => 'required|numeric',
            'movil_phone.*' => 'required|numeric',
        ];
    }
}
