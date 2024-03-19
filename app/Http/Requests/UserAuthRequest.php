<?php

namespace App\Http\Requests;

/**
 * Class UserAuthRequest
 *
 * @package App\Http\Requests
 * @author Mahammad Mammadov
 */
class UserAuthRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Xananı doldurun!',
            'password.required'  => 'Xananı doldurun!',
            'email.email'  => 'Etibarlı bir e-poçt ünvanı olmalıdır!',
            'email.unique'  => 'e-poçt ünvanı artıq istifadə edilib!',
            'password.min' => 'Şifrə ən azı 6 simvoldan ibarət olmalıdır!',
        ];
    }
}
