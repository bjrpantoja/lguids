<?php

namespace app\Http\Requests;

use app\Http\Requests\Request;

class ContactValidation extends Request
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
            'c_fname'           => 'required',
            'c_mname'           => 'required',
            'c_lname'           => 'required',
            'c_number'          => 'required|regex:/^639/|digits:12',
            'c_agency'          => '',
            'c_position'        => '',
            'groups'            => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'c_fname'           => 'First Name',
            'c_mname'           => 'Middle Name',
            'c_lname'           => 'Last Name',
            'c_number'          => 'Mobile Number',
            'c_agency'          => 'Agency',
            'c_position'        => 'Position',
            'groups'            => 'Group'
        ];
    }

    public function messages()
    {
        return [
            'regex' => 'The Mobile Number must starts with 639'
        ];
    }
}
