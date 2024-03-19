<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class InvalidPasswordException
 * @package App\Exceptions
 * @author  Mahammad Mammadov <codega.az@gmail.com>
 */
class InvalidPasswordException extends Exception
{
    /**
     * InvalidPasswordException constructor.
     */
    public function __construct()
    {
        parent::__construct(__('auth.invalid_password'), JsonResponse::HTTP_BAD_REQUEST);
    }
}
