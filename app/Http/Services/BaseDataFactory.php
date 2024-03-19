<?php

namespace App\Http\Services;

/**
 * Class BaseDataFactory
 *
 * @package App\Http\Services
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
abstract class BaseDataFactory implements DataFactoryInterface
{
    /**
     * @var array
     */
    public $data;

    /**
     * @var array
     */
    public $params;

    /**
     * AbstractDataFactory constructor
     *
     * @param array $data
     * @param array $params
     */
    public function __construct(array $data, array $params = [])
    {
        $this->data = $data;
        $this->params = $params;
    }
}
