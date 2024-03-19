<?php

namespace App\Http\Repositories\User;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Http\Repositories\User
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
interface UserRepositoryInterface
{
    /**
     * Find user by email
     *
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email);

    /**
     * Get all user's offers
     *
     * @param string $guard
     * @return mixed
     */
    public function userAllOffers(string $guard);

    /**
     * Filter by district and category
     *
     * @param string $guard
     * @return mixed
     */
    public function userOffersFilter(string $guard);
}
