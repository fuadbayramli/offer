<?php

namespace App\Http\Services;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\UserNotFoundException;
use App\Http\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserAuthorization
 *
 * @package App\Services
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class UserAuthorization
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var
     */
    protected $guard = 'site-user';

    /**
     * UserAuthorization constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Check up user credentials
     *
     * @param string $email
     * @param string $password
     * @return mixed|null
     * @throws InvalidPasswordException
     * @throws UserNotFoundException
     */
    public function loginAttempt(string $email, string $password)
    {
        $user = $this->userRepository->findByEmail($email);

        if(!isset($user)) {
            throw new UserNotFoundException();
        }

        $validPassword = Hash::check($password, $user->getAuthPassword());

        if (!$validPassword) {
            throw new InvalidPasswordException();
        }

        return $user;
    }

    /**
     * Change user password
     *
     * @param string $oldPassword
     * @param string $newPassword
     * @return mixed
     * @throws InvalidPasswordException
     * @throws SamePasswordException
     */
    public function verifyPassword(string $oldPassword, string $newPassword)
    {
        $user = $this->userRepository->show(Auth::guard($this->guard)->id());

        $validPassword = Hash::check($oldPassword, $user->getAuthPassword());

        if (!$validPassword) {
            throw new InvalidPasswordException();
        }
        /*
        $validPassword = Hash::check($newPassword, $user->getAuthPassword());

        if ($validPassword) {
            throw new AlreadyLikedException();
        }*/

        $params['password'] = Hash::make($newPassword);

        return $this->userRepository->update($user->id, $params);
    }
}
