<?php

namespace App\Http\Requests;

use App\OfferFile;

/**
 * Class UpdateOfferRequest
 *
 * @package App\Http\Requests
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class UpdateOfferRequest extends CustomFormRequest
{
    private const UPLOAD_IMAGE_LIMIT = 5;
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
            'images' => 'nullable|array|max:'.$this->uploadImageLimit(),
            'images.*' => 'nullable|mimes:jpeg,bmp,png|max:5000',
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
            'district_id.required'  => 'Rayon Xanasını seçin!',
            'description.required'  => 'Xananı doldurun!',
            'title.max' => 'Tǝklifin başlığı 255 simvoldan artıq olmamalıdır!',
            'area.max' => 'Ərazi 255 simvoldan artıq olmamalıdır!',
            'images.max' => $this->uploadImageLimitMessage(),
            'images.*.max' =>  'Şəklin ölçüsü 5mb-dan artıq olmamalıdır!',
            'images.*.mimes' =>  'Şəkil jpeg, bmp, png formatında olmalıdır!',
            'category_id.exists' => 'Seçilmiş kateqoriya mövcud deyil!',
            'district_id.exists' => 'Seçilmiş rayon mövcud deyil!'
        ];
    }

    /**
     * Uplaod limit message
     *
     * @return string
     */
    protected function  uploadImageLimitMessage()
    {
        $id = $this->route('id');
        $maxCount = self::UPLOAD_IMAGE_LIMIT - OfferFile::where('offer_id', $id)->count();

        if($maxCount === 0) {
         return  'Şəkil yükləmək üçün sizə ayrılmış limit qurtarib.';
        }

        return 'Şəkil sayı '.$maxCount.'-dən artıq olmamalıdır!';
    }

    /**
     * @return int
     */
    protected function  uploadImageLimit()
    {
        $id = $this->route('id');
        $maxCount = self::UPLOAD_IMAGE_LIMIT - OfferFile::where('offer_id', $id)->count();

        return $maxCount;
    }
}
