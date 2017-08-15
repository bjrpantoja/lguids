<?php

namespace app\Http\Requests;

use app\Http\Requests\Request;

class BulletinValidation extends Request
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
            'recipients'        => 'required',
            'bt_id'             => 'required',
            'bl_message'        => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'recipients'        => 'Recipients',
            'bt_id'             => 'Bulletin Type',
            'bl_message'        => 'Bulletin Message'
        ];
    }
}