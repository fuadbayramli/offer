<?php

namespace App\Http\Services;

/**
 * Interface DataFactoryInterface
 *
 * @package App\Http\Services
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
interface DataFactoryInterface
{
    /**
     * DataFactoryInterface constructor
     *
     * @param array $data
     * @param array $params
     */
    public function __construct(array $data, array $params = []);

    /**
     * Get custom data for inserting
     * @return array
     */
    public function getData(): array;
}
