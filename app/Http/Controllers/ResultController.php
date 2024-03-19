<?php

namespace App\Http\Controllers;

use App\Exceptions\AlreadyLikedException;
use App\Exceptions\AlreadyLikedJsonException;
use App\Exceptions\JsonException;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\District\DistrictRepository;
use App\Http\Repositories\Result\ResultRepository;
use App\Http\Requests\ResultLikeRequest;
use App\Http\Services\ResultService;
use App\Http\Traits\Responsible;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

/**
 * Class ResultController
 *
 * @package App\Http\Controllers
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultController extends Controller
{
    use Responsible;

    /**
     * @var ResultRepository
     */
    protected $resultRepository;

    /**
     * @var
     */
    protected $categoryRepository;

    /**
     * @var
     */
    protected $districtRepository;

    /**
     * @var ResultService
     */
    protected $resultService;

    protected $guard = 'site-user';

    /**
     * ResultController constructor.
     *
     * @param ResultRepository $resultRepository
     * @param ResultService $resultService
     * @param CategoryRepository $categoryRepository
     * @param DistrictRepository $districtRepository
     */
    public function __construct(
        ResultRepository $resultRepository,
        ResultService $resultService,
        CategoryRepository $categoryRepository,
        DistrictRepository $districtRepository
    )
    {
        $this->resultRepository = $resultRepository;
        $this->categoryRepository = $categoryRepository;
        $this->districtRepository = $districtRepository;
        $this->resultService = $resultService;
    }

    /**
     * get all results
     *
     * @return Factory|View
     */
    public function all()
    {
        $results = $this->resultRepository->all($params = []);
        $districts = $this->districtRepository->all($params = []);
        $categories = $this->categoryRepository->all($params = []);

        return view('pages.results')
            ->with([
                    'results' => $results,
                    'districts' => $districts,
                    'categories' => $categories,
                   ]);
    }

    /**
     * Get result by id
     *
     * @param int $id
     * @return JsonResponse
     * @throws JsonException
     */
    public function show(int $id)
    {
        try {
            $result = $this->resultService->findById($id);
        } catch (ModelNotFoundException $e) {
           abort(404);
        } catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }
       // return  $this->successResponse(__('messages.result_success'),  ['result' => $result],  JsonResponse::HTTP_OK);
        return view('pages.result-inner')->with('result', $result);
    }

    /**
     * Result like
     *
     * @param ResultLikeRequest $resultLikeRequest
     * @return JsonResponse
     * @throws AlreadyLikedJsonException
     * @throws JsonException
     */
    public function resultLike(ResultLikeRequest $resultLikeRequest)
    {
        $data = $resultLikeRequest->validated();

        try {
            $resultLike = $this->resultService->like($data);
        } catch (ModelNotFoundException $e) {
            throw new JsonException(__('messages.not_found'), JsonResponse::HTTP_NOT_FOUND);
        } catch (AlreadyLikedException $e) {
            throw new AlreadyLikedJsonException($e->getMessage(), $e->getCode());
        }
        catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return  $this->successResponse(__('messages.result_like_success'),  ['resultLike' => $resultLike],  JsonResponse::HTTP_OK);
    }

    /**
     * Result Search
     *
     * @return Factory|View
     */
    public function resultSearch()
    {
        $results = $this->resultService->search();
        $categories = $this->categoryRepository->all();
        $districts = $this->districtRepository->all();

        return view('pages.results')
            ->with([
                    'results' => $results,
                    'districts' => $districts,
                    'categories' => $categories,
                   ]);
    }
}
