<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

/**
 * Class ResultDataFactory
 *
 * @package App\Http\Services
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultDataFactory extends BaseDataFactory
{
    protected $guard = 'site-user';
    /**
     * Get custom data for inserting
     * @return array
     */
    public function getData(): array
    {
        $user_id = Auth::guard($this->guard)->id();

        return [
            'title' => $this->data['title'],
            'area' => $this->data['area'],
            'description' => $this->data['description'],
            'category_id' => $this->data['category_id'] ?? 0,
            'district_id' => $this->data['district_id'] ?? 0,
            'user_id' => $user_id,
            'anonymous' => $this->data['anonymous'] ?? 0
        ];
    }
}
