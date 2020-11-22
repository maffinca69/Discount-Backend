<?php


namespace App\Http\Requests\Categories;


use App\Http\Requests\BaseRequest;

class CategoryDeleteRequest extends BaseRequest
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
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'Категория не найдена',
        ];
    }
}
