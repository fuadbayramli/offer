<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class AlreadyLikedException
 *
 * @package App\Exceptions
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class AlreadyLikedException extends Exception
{
  public function __construct()
  {
      parent::__construct(__('messages.already_liked'), JsonResponse::HTTP_BAD_REQUEST);
  }
}
