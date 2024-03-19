<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class InvalidTokenException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class InvalidTokenException extends Exception
{
    /**
     * InvalidTokenException constructor.
     */
    public function __construct()
    {
        parent::__construct(__('passwords.token'), JsonResponse::HTTP_BAD_REQUEST);
    }
}
