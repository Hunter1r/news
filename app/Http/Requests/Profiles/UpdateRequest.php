<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            // 'name' => ['required', 'max:150'],
            // 'email' => ['required', 'email:rfc,dns'],
            // 'password' => ['required'],
        ];
    }

    public function attributes() {
        return [
            'name' => 'Имя',
            'email' =>'Электронная почта',
            'password' =>'Пароль',
        ];
    }

    public function messages() {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'max' => 'Поле :attribute превышает максимально допустимую длину',
        ];
    }
}

