<?php

namespace App\Http\Requests;

/**
 * Class OfferLikeRequest
 *
 * @package App\Http\Requests
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultLikeRequest extends CustomFormRequest
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
            'id' => 'required|integer'
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
            'id.required' => 'Nəticə id boş ola bilməz!',
            'id.integer'  => 'Nəticə id tam rəqəm olmalıdır!',
        ];
    }
}
