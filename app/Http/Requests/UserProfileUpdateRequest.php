<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

/**
 * Class UserProfileUpdateRequest
 *
 * @package App\Http\Requests
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class UserProfileUpdateRequest extends CustomFormRequest
{
    protected $guard = 'site-user';
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:site_users,email,'.Auth::guard($this->guard)->id(),
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'fatherName' => 'required|string|max:255',
            'phonenumber' =>'required|string',
            'address' => 'nullable'
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
            'name.required'  => 'Xananı doldurun!',
            'surname.required'  => 'Xananı doldurun!',
            'fatherName.required'  => 'Xananı doldurun!',
            'phonenumber.required'  => 'Xananı doldurun!',
            'email.email'  => 'Etibarlı bir e-poçt ünvanı olmalıdır!',
            'email.unique'  => 'e-poçt ünvanı artıq istifadə edilib!',
            'phonenumber.numeric'  => 'Telefon nömrǝsi rəqəm olmalıdır!',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
