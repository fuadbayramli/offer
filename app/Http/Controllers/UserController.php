<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonException;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\District\DistrictRepository;
use App\Http\Repositories\User\UserRepository;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Traits\Responsible;
use App\Notifications\UserRegister;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mamadov <codega.az@gmail.com>
 */
class UserController extends Controller
{
    use Responsible;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var string
     */
    protected $guard = 'site-user';

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
     //   $this->middleware('recruit', [ 'only '=> 'postUpdateInfo' ]);
    }

    /**
     * Get all user list
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $users = $this->userRepository->all();

        return  $this->successResponse(__('messages.success'),
            ['users' => $users],
            JsonResponse::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Factory|View
     * @throws JsonException
     */
    public function show(int $id)
    {
        try {
            $user = $this->userRepository->show($id);
        } catch (ModelNotFoundException $e) {
            throw new JsonException(__('messages.not_found'), JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return view('pages.user-profile')->with('user', $user);
    }

    /**
     * Create New User
     *
     * @param UserRequest $request
     * @return JsonResponse
     * @throws JsonException
     */
    public function store(UserRequest $request): JsonResponse
    {
       try{
           $data = $request->validated();
           $user = $this->userRepository->create($data);
           $user->notify(new UserRegister());
       } catch (Exception $e) {
           print $e->getMessage();
           throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
       }

      return  $this->successResponse(__('messages.success_registration'),
             ['user' => $user],
            JsonResponse::HTTP_OK);
    }

    /**
     * Update existing user profile
     *
     * @param int $id
     * @param UserProfileUpdateRequest $request
     * @return JsonResponse
     * @throws JsonException
     */
    public function update(
        int $id,
        UserProfileUpdateRequest $request
    ) {
        $params = $request->validated();
        try {
            $data = $this->userRepository->update($id, $params);
        } catch (ModelNotFoundException $e) {
            throw new JsonException(__('messages.not_found'), JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $e) {
           throw new JsonException($e->getMessage(), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successResponse(
            __('messages.success'),
            ['user' => $data],
            JsonResponse::HTTP_ACCEPTED
        );
    }

    /**
     * Get all offers of user
     *
     * @param CategoryRepository $categoryRepository
     * @param DistrictRepository $districtRepository
     * @throws JsonException
     * @return View|Factory
     */
    public function getUserOffers(
        CategoryRepository $categoryRepository,
        DistrictRepository $districtRepository
    )
    {
        try {
            $categories = $categoryRepository->all();
            $districts = $districtRepository->all();
            $userOffers = $this->userRepository->userAllOffers($this->guard);
        } catch (Exception $e) {
            throw new JsonException($e->getMessage(), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return view('pages.my-offers')
            ->with([
                    'userOffers' => $userOffers,
                    'categories' => $categories,
                    'districts' => $districts
                   ]);
    }

    /**
     * Get all results of user
     *
     * @param CategoryRepository $categoryRepository
     * @param DistrictRepository $districtRepository
     * @throws JsonException
     * @return View|Factory
     */
    public function getUserResults(
        CategoryRepository $categoryRepository,
        DistrictRepository $districtRepository
    )
    {
        try {
            $categories = $categoryRepository->all();
            $districts = $districtRepository->all();
            $userResults = $this->userRepository->userAllResults($this->guard);
        } catch (Exception $e) {
            throw new JsonException($e->getMessage(), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return view('pages.my-results')
            ->with([
                'userResults' => $userResults,
                'categories' => $categories,
                'districts' => $districts
            ]);
    }

}
