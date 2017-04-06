<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class educationRequest extends Request
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
            'career'   => 'min:4|',
            'name'     => 'required|min:8|',        
            'period'   => 'required|min:9|',
            'address'  => 'required|min:8|',
            'city'     => 'required|min:3|',
            'id_state' => 'required',
        ];
    }
}
