<?php

namespace app\Http\Requests;

use Input;

use app\Http\Requests\Request;

class UserValidation extends Request
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
            'u_fname'           => 'required|min:2',
            'u_mname'           => 'required',
            'u_lname'           => 'required|min:2',
            'u_username'        => 'required|alpha_num|min:3|unique:h_users,u_username,'.Input::get('id').',u_id',
            'u_password'        => 'required|min:8',
            'u_number'          => 'required|regex:/^639/|digits:12|unique:h_users,u_number,'.Input::get('id').',u_id',
            'is_updated'        => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'u_fname'           => 'First Name',
            'u_mname'           => 'Middle Name',
            'u_lname'           => 'Last Name',
            'u_number'          => 'Mobile NUmber',
            'u_username'        => 'Username',
            'u_password'        => 'Password',
            'is_updated'        => 'Automated Bulletins'
        ];
    }
}
