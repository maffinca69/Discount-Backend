<?php

namespace App\Http\Requests\Cities;

use App\Http\Requests\BaseRequest;

class CityCreateRequest extends BaseRequest
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
            'name' => 'required|unique:cities,name'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Это обязательное поле',
            'name.unique' => 'Город с таким названием уже создан'
        ];
    }
}
