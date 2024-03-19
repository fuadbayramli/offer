<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class UserNotFoundException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov
 * */
class UserNotFoundException extends Exception{
    /**
     * UserNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct(__('auth.login_not_found'), JsonResponse::HTTP_NOT_FOUND);
    }
}
