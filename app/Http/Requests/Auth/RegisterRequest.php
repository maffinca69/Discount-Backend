<?php


namespace App\Http\Requests\Auth;


use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
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
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6', // password_confirmation
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute обязательное поле',
            '*.min' => 'Минимум :min символов',

            'email.unique' => 'Пользователь с таким email уже зарегистрирован',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
