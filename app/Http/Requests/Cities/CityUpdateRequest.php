<?php


namespace App\Http\Requests\Cities;


use App\Http\Requests\BaseRequest;

class CityUpdateRequest extends BaseRequest
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
            'id' => 'required|exists:cities,id',
            'name' => 'required|unique:cities,name,' . request('id')
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Это обязательное поле',
            'name.unique' => 'Город с таким названием уже создан',

            'id.exists' => 'Город не найден'
        ];
    }
}
