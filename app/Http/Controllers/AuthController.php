<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\InvalidPasswordJsonException;
use App\Exceptions\JsonException;
use App\Exceptions\AlreadyLikedJsonException;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserNotFoundJsonException;
use App\Http\Requests\ChangeUserPasswordRequest;
use App\Http\Requests\UserAuthRequest;
use App\Http\Traits\Responsible;
use App\Http\Services\UserAuthorization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Exception;
/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class AuthController extends Controller
{
    use Responsible;

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * AuthController constructor.
     *
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
      $this->auth = $auth;
    }

    /**
     * Authorization user
     *
     * @param UserAuthRequest $userAuthRequest
     * @param UserAuthorization $userAuthorization
     * @return JsonResponse
     * @throws InvalidPasswordJsonException
     * @throws JsonException
     * @throws UserNotFoundJsonException
     */
    public function auth(
     UserAuthRequest $userAuthRequest,
     UserAuthorization $userAuthorization
    )
    {
        $data = $userAuthRequest->validated();

        try {
            $userAuthorization->loginAttempt($data['email'], $data['password']);
            $user = $this->auth::guard('site-user')->attempt($data);
        }  catch (UserNotFoundException $e) {
            throw new UserNotFoundJsonException($e->getMessage(), $e->getCode());
        } catch (InvalidPasswordException $e) {
            throw new InvalidPasswordJsonException($e->getMessage(), $e->getCode());
        } catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successResponse(__('auth.success_login'), ['user'=>$user]);
    }

    /**
     * Change user password
     *
     * @param ChangeUserPasswordRequest $changeUserPasswordRequest
     * @param UserAuthorization $userAuthorization
     * @return JsonResponse
     *@throws AlreadyLikedJsonException
     * @throws JsonException
     * @throws InvalidPasswordJsonException
     */
    public function changePassword(
     ChangeUserPasswordRequest $changeUserPasswordRequest,
     UserAuthorization $userAuthorization
    ): JsonResponse
    {
        $data = $changeUserPasswordRequest->validated();

        try {
          $userAuthorization->verifyPassword($data['old_password'], $data['new_password']);
        } catch(InvalidPasswordException $e) {
            throw new InvalidPasswordJsonException($e->getMessage(), $e->getCode());
        } catch(Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successResponse(__('auth.password_change_success'));
    }

    /**
     * User logout
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        $this->auth::guard('site-user')->logout();

        return redirect()->route('main.page');
    }
}
