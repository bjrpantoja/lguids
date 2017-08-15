<?php

namespace app\Http\Requests;

use app\Http\Requests\Request;

class MapValidation extends Request
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
            'm_name'           => 'required',
            'm_type'           => 'required',
            'm_path'           => 'required|image',
        ];
    }

    public function attributes()
    {
        return [
            'm_name'           => 'Map Name',
            'm_type'           => 'Map Type',
            'm_path'           => 'Map File',
        ];
    }
}
