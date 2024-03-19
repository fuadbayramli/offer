<?php

namespace App\Http\Requests;

/**
 * Class OfferRequest
 *
 * @package App\Http\Requests
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferRequest extends CustomFormRequest
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
            'title' => 'required|max:255',
            'area' => 'required|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'district_id' => 'required|integer|exists:districts,id',
            'images' => 'required|array|max:5',
//            'images.*' => 'required|mimes:jpeg,bmp,png|max:5000',
            'videos' => 'array|max:3',
            'videos.*' => 'required|mimes:mp4|max:10000',
            'description' => 'required',
            'anonymous' => 'nullable'
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
            'title.required' => 'Xananı doldurun!',
            'area.required'  => 'Xananı doldurun!',
            'category_id.required'  => 'Kateqoriya Xanasını seçin!',
            'district_id.required'  => 'Təklifin aid olduğu rayonu qeyd edin!',
            'images.required'  => 'Xananı doldurun!',
//            'videos.required'  => 'Xananı doldurun!',
            'description.required'  => 'Xananı doldurun!',
            'title.max' => 'Tǝklifin başlığı 255 simvoldan artıq olmamalıdır!',
            'area.max' => 'Ərazi 255 simvoldan artıq olmamalıdır!',
            'images.max' => 'Şəkillərin sayı 5-dən artıq olmamalıdır!',
            'images.*.max' =>  'Şəklin ölçüsü 5mb-dan artıq olmamalıdır!',
            'images.*.mimes' =>  'Şəkil jpeg, bmp, png formatında olmalıdır!',
            'videos.max' => 'Videoların sayı 3-dən artıq olmamalıdır!',
            'videos.*.max' =>  'Videonun ölçüsü 10mb-dan artıq olmamalıdır!',
            'videos.*.mimes' =>  'Video mp4 formatında olmalıdır!',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil!',
            'district_id.exists' => 'Seçilmiş rayon mövcud deyil!'
        ];
    }
}
