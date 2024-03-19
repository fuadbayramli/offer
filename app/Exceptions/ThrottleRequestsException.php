<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

/***
 * Class ThrottleRequestsException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class ThrottleRequestsException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('passwords.throttled'), JsonResponse::HTTP_TOO_MANY_REQUESTS);
    }

}
