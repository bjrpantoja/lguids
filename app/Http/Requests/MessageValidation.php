<?php

namespace app\Http\Requests;

use app\Http\Requests\Request;

class MessageValidation extends Request
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
            'sms_number'        => 'required|regex:/^639/|digits:12',
            'sms_message'       => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'sms_number'        => 'Mobile Number',
            'sms_message'       => 'Message'
        ];
    }

    public function messages()
    {
        return [
            'regex' => 'The Mobile Number must starts with 639'
        ];
    }
}
