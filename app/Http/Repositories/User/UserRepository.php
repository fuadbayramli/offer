<?php

namespace App\Http\Repositories\User;

use App\Http\Repositories\BaseRepository;
use App\SiteUser;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 *
 * @package App\Http\Repositories\User
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param SiteUser $model
     */
    public function __construct(SiteUser $model)
    {
        parent::__construct($model);
    }

    /**
     * Create new user record
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
       $data['password'] = bcrypt($data['password']);
       $data['address'] = $data['address'] ?? null;
       $data['phonenumber'] = $this->getInt($data['phonenumber']);

       return parent::create($data);
    }

    /**
     * Find user by Email
     *
     * @param string $email
     * @return mixed|null
     */
    public function findByEmail(string $email)
    {
        $user = $this->model->where('email', '=', $email)->first();

        if (!$user) {
            return null;
        }

        return $user;
    }

    /**
     * Get all offers of user
     *
     * @param string $guard
     * @return
     */
    public function userAllOffers(string $guard)
    {
        return $this->userOffersFilter($guard)->get()->toArray();
    }

    /**
     * Get all results of user
     *
     * @param string $guard
     * @return
     */
    public function userAllResults(string $guard)
    {
        return $this->userResultsFilter($guard)->get()->toArray();
    }

    /**
     * Filter by district and category
     *
     * @param string $guard
     * @return
     */
    public function userOffersFilter(string $guard)
    {
        $userOffers = Auth::guard($guard)->user()
            ->offers()
            ->with('image')
            ->withCount('likes')
            ->where('status', 1);

        if (
            isset(request()->district_id) && request()->district_id &&
            isset(request()->category_id) && request()->category_id
        ) {
            $userOffers = $userOffers
                ->where([
                         'category_id' => request()->category_id,
                         'district_id' => request()->district_id
                        ]);
        }

        return $userOffers;
    }

    /**
     * Filter by district and category
     *
     * @param string $guard
     * @return
     */
    public function userResultsFilter(string $guard)
    {
        $userResults = Auth::guard($guard)->user()
            ->results()
//            ->with('image')
            ->withCount('likes')
            ->where('status', 1);

        if (
            isset(request()->district_id) && request()->district_id &&
            isset(request()->category_id) && request()->category_id
        ) {
            $userResults = $userResults
                ->where([
                    'category_id' => request()->category_id,
                    'district_id' => request()->district_id
                ]);
        }

        return $userResults;
    }

    /**
     * Get integer value
     *
     * @param $str
     * @return string|string[]
     */
    protected function getInt($str)
    {
        $str = str_replace(array('+', '-' , '(', ')', ' '), '', $str);
        return $str;
    }

}
