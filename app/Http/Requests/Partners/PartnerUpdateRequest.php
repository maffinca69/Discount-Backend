<?php


namespace App\Http\Requests\Partners;


use App\Http\Requests\BaseRequest;

class PartnerUpdateRequest extends BaseRequest
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
            'id' => 'required|exists:partners,id',
            'name' => 'required',
            'logo_url' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'info' => 'nullable|max:255',
            'min_discount' => 'min:0|max:100',
            'max_discount' => 'min:0|max:100',

            'addresses.*.street' => 'required|max:255',
            'addresses.*.house' => 'required|max:255',
            'addresses.*.contact_phone' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'Партнер не найден',

            '*.required' => ':attribute обязательное поле',
            '*.max' => 'Максимум :max символов',
            '*.min' => 'Минимум :min символов',

            'cities.*' => 'Город не найден',
            'category_id.exists' => 'Категория не найдена',
            'addresses.*' => 'Не все поля адресов заполнены'
        ];
    }
}
