<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordReset;
/**
 * Class SiteUser
 *
 * @package App
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class SiteUser extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $guard = 'site-user';

    /**
     * @var string
     */
    protected $table = 'site_users';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'fatherName', 'email', 'password', 'phonenumber', 'address'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user's all offers
     *
     * @return BelongsTo
     */
    public function offers(): hasMany
    {
        return $this->hasMany(Offer::class, 'user_id', 'id')->orderBy('created_at', 'DESC');
    }

    /**
     * Get user's all offers
     *
     * @return BelongsTo
     */
    public function results(): hasMany
    {
        return $this->hasMany(Result::class, 'user_id', 'id')->orderBy('created_at', 'DESC');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
}
