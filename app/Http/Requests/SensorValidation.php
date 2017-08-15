<?php

namespace app\Http\Requests;

use app\Http\Requests\Request;

class SensorValidation extends Request
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
            'ss_address'        => 'required',
            'ss_latitude'       => 'required|regex:/^\d+\.\d+$/',
            'ss_longitude'      => 'required|regex:/^\d+\.\d+$/',
            'ss_elevation'      => 'required|numeric',
            'dev_id'            => 'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'ss_address'        => 'Sensor Address',
            'ss_latitude'       => 'Latitude',
            'ss_longitude'      => 'Longitude',
            'ss_elevation'      => 'Elevation',
            'dev_id'            => 'Device ID'
        ];
    }
}
