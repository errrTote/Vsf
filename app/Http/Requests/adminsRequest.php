<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class adminsRequest extends Request
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
            'first_name'  =>'required|alpha|min:3|max:16',
            'middle'      =>'alpha|min:3|max:16',
            'last_name'   =>'required|alpha|min:3|max:16',
            'name_mother' =>'alpha|min:3|max:16',
            'email'       =>'unique:admins,email|required|email',
            'password'    =>'required|min:8|max:32',
            'repasword'   =>'same:password|required|min:8|max:32'
        ];
    }
}
