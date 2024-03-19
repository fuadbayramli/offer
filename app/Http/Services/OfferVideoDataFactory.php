<?php

namespace App\Http\Services;

use Carbon\Carbon;

/**
 * Class OfferVideoDataFactory
 *
 * @package App\Http\Services
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class OfferVideoDataFactory extends BaseDataFactory
{

    /**
     * Get custom data for inserting
     * @return array
     */
    public function getData(): array
    {
        $data = [];
        $now = Carbon::now()->toDateTimeString();

        if ($this->data) {
            foreach ($this->data as $file) {
                $data[] = array_merge(
                    [
                        'path' => $file,
                        'created_at' => $now,
                        'updated_at' => $now
                    ],
                    $this->params
                );
            }
        }

        return $data;
    }
}
