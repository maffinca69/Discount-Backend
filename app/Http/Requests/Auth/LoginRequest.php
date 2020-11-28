<?php


namespace App\Http\Requests\Auth;


use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute обязательное поле',
            '*.min' => 'Минимум :min символов',

            'email.exists' => 'Пользователь с таким email не найден',
        ];
    }
}
