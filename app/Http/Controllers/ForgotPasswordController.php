<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidTokenException;
use App\Exceptions\InvalidTokenJsonException;
use App\Exceptions\JsonException;
use App\Exceptions\ThrottleRequestsException;
use App\Exceptions\ThrottleRequestsJsonException;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserNotFoundJsonException;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Services\ForgotPasswordService;
use App\Http\Traits\Responsible;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\View\View;

/**
 * Class ForgotPasswordController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class ForgotPasswordController extends Controller
{
    use Responsible;

    /**
     * @var ForgotPasswordService
     */
    protected $forgotPasswordService;

    /**
     * ForgotPasswordController constructor.
     *
     * @param ForgotPasswordService $forgotPasswordService
     */
    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
      $this->forgotPasswordService = $forgotPasswordService;
    }

    /**
     * Send reset link to user email
     *
     * @param ForgotPasswordRequest $forgotPasswordRequest
     * @return JsonResponse
     * @throws JsonException
     * @throws UserNotFoundJsonException
     * @throws ThrottleRequestsJsonException
     */
    public function forgot(ForgotPasswordRequest $forgotPasswordRequest)
    {
        $data = $forgotPasswordRequest->validated();

        try {
            $response = $this->forgotPasswordService->forgotPasswordLink($data);
        } catch (UserNotFoundException $e) {
           throw new UserNotFoundJsonException($e->getMessage(), $e->getCode());
        } catch(ThrottleRequestsException $e) {
            throw new ThrottleRequestsJsonException($e->getMessage(), $e->getCode());
        } catch(Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return  $this->successResponse(__('passwords.sent'),  ['resetLink' => $response],  JsonResponse::HTTP_OK);
    }

    /**
     * Reset Password
     *
     * @param ResetPasswordRequest $resetPasswordRequest
     * @return JsonResponse
     * @throws InvalidTokenJsonException
     * @throws JsonException
     * @throws UserNotFoundJsonException
     */
    public function reset(ResetPasswordRequest $resetPasswordRequest)
    {
      $credentials = $resetPasswordRequest->validated();

      try{
          $resetUserPassword = $this->forgotPasswordService->resetPassword($credentials);
      } catch (UserNotFoundException $e) {
         throw new UserNotFoundJsonException($e->getMessage(), $e->getCode());
      } catch (InvalidTokenException $e) {
          throw new InvalidTokenJsonException($e->getMessage(), $e->getCode());
      } catch(Exception $e) { print $e->getMessage();
          throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
      }

      return  $this->successResponse(__('passwords.reset'),  ['resetPassword' => $resetUserPassword],  JsonResponse::HTTP_OK);
    }

    /**
     * Show password reset Form
     *
     * @return Factory|View
     */
    public function showResetForm()
    {
        return view('pages.password-reset');
    }
}
