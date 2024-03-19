<?php

namespace App\Http\Requests;

/**
 * Class ChangeUserPasswordRequest
 *
 * @package App\Http\Requests
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class ChangeUserPasswordRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|same:new_password',
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
            'old_password.required' => 'Xananı doldurun!',
            'new_password.required'  => 'Xananı doldurun!',
            'confirm_password.required'  => 'Xananı doldurun!',
            'new_password.min' => 'Şifrə ən azı 6 simvoldan ibarət olmalıdır!',
            'new_password.different' => 'Təkrar şifrə cari şifrə ilə eyni ola bilməz!',
            'confirm_password.same'  => 'Tǝkrar şifrǝ  uyğun deyil!',
        ];
    }

}
