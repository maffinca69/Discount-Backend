<?php


namespace App\Http\Requests\Categories;


use App\Http\Requests\BaseRequest;

class CategoryUpdateRequest extends BaseRequest
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
            'id' => 'required|exists:categories,id',
            'name' => 'required|unique:categories,name,' . request('id'),
            'icon' => 'max:255'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute обязательное поле',
            'id.exists' => 'Категория не существует',
            'name.unique' => 'Такая категория уже создана',
        ];
    }
}
