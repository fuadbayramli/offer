<?php

namespace App\Http\Requests;

/**
 * Class ResetPasswordRequest
 *
 * @package App\Http\Requests
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class ResetPasswordRequest  extends CustomFormRequest
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
            'passwordConfirmation' => 'required|min:6|same:password',
            'token' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Xananı doldurun!',
            'password.required'  => 'Xananı doldurun!',
            'token.required' => 'Tokeni daxil edin!',
            'passwordConfirmation.required'  => 'Xananı doldurun!',
            'email.email'  => 'Etibarlı bir e-poçt ünvanı olmalıdır!',
            'passwordConfirmation.same'  => 'Tǝkrar şifrǝ  uyğun deyil!',
            'password.min' => 'Şifrə ən azı 6 simvoldan ibarət olmalıdır!',
            'passwordConfirmation.min' => 'Şifrə ən azı 6 simvoldan ibarət olmalıdır!'
        ];
    }
}
