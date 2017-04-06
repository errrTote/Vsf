<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class updatePersonalRequest extends Request
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
            'gender'                => 'required',           
            'permanent_address'     => 'min:8|max:120|required',
            'permanent_city'        => 'min:3|max:24|required|alpha',
            'permanent_postal_code' => 'min:4|required|numeric',
            'id_permanent_state'    => 'required',
            'residence_address'     => 'min:8|max:120',
            'residence_city'        => 'min:3|max:24|alpha',
            'residence_postal_code' => 'min:4|numeric',
            'birth_date'            => 'required|date',
            'birth_city'            => 'min:3|max:120|required',
            'id_birth_state'        => 'required',
            'home_phone'            => 'min:11|numeric',
            'movil_phone'           => 'min:11|numeric',
        ];
    }
}
