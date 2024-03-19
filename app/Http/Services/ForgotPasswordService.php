<?php

namespace App\Http\Services;

use App\Exceptions\InvalidTokenException;
use App\Exceptions\ThrottleRequestsException;
use App\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Password;

/**
 * Class ForgotPasswordService
 *
 * @package App\Http\Services
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class ForgotPasswordService
{
    /**
     * @var string
     */
   protected $broker = 'site_users';

    /**
     * Created Password reset link
     *
     * @param array $data
     * @return bool
     * @throws ThrottleRequestsException
     * @throws UserNotFoundException
     */
   public function forgotPasswordLink(array $data)
   {
       $response = $this->broker()->sendResetLink($data);

       switch ($response) {
           case Password::RESET_LINK_SENT:
               return true;
           case Password::INVALID_USER:
               throw new UserNotFoundException();
           case Password::RESET_THROTTLED:
               throw new ThrottleRequestsException();
       }
   }

    /**
     * Reset Password
     *
     * @param array $data
     * @return bool
     * @throws InvalidTokenException
     * @throws UserNotFoundException
     */
   public function resetPassword(array $data)
   {
       $response =  $this->broker()->reset($data, function($user, $password){
           $this->resetPasswordModel($user, $password);
       });

       switch ($response) {
           case Password::INVALID_USER:
               throw new UserNotFoundException();
           case Password::INVALID_TOKEN:
               throw new InvalidTokenException();
           case Password::PASSWORD_RESET:
               return true;
       }
   }

    /**
     * For SiteUser Model
     *
     * @return mixed
     */
   protected  function broker()
   {
       return Password::broker($this->broker);
   }

    /**
     * Update user password
     *
     * @param $user
     * @param $password
     */
   protected function resetPasswordModel($user, $password)
   {
       $user->forceFill([
           'password' => bcrypt($password)
       ])->save();
   }
}
