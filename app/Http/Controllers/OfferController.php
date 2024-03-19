<?php

namespace App\Http\Controllers;

use App\Exceptions\AlreadyLikedException;
use App\Exceptions\AlreadyLikedJsonException;
use App\Exceptions\JsonException;
use App\Http\Repositories\Category\CategoryRepository;
use App\Http\Repositories\District\DistrictRepository;
use App\Http\Repositories\Offer\OfferRepository;
use App\Http\Requests\OfferLikeRequest;
use App\Http\Requests\OfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Http\Services\OfferService;
use App\Http\Traits\Responsible;
use App\Notifications\OfferCreate;
use App\OfferFile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

/**
 * Class OfferController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferController extends Controller
{
    use Responsible;

    /**
     * @var OfferRepository
     */
    protected $offerRepository;

    /**
     * @var
     */
    protected $categoryRepository;

    /**
     * @var
     */
    protected $districtRepository;

    /**
     * @var OfferService
     */
    protected $offerService;

    protected $guard = 'site-user';

    /**
     * OfferController constructor.
     *
     * @param OfferRepository $offerRepository
     * @param OfferService $offerService
     * @param CategoryRepository $categoryRepository
     * @param DistrictRepository $districtRepository
     */
    public function __construct(
        OfferRepository $offerRepository,
        OfferService $offerService,
        CategoryRepository $categoryRepository,
        DistrictRepository $districtRepository
    )
    {
        $this->offerRepository = $offerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->districtRepository = $districtRepository;
        $this->offerService = $offerService;
    }

    /**
     * get all offers
     *
     * @return Factory|View
     */
    public function all()
    {
        $offers = $this->offerRepository->all($params = []);
        $districts = $this->districtRepository->all($params = []);
        $categories = $this->categoryRepository->all($params = []);

        return view('pages.offers')
            ->with([
                    'offers' => $offers,
                    'districts' => $districts,
                    'categories' => $categories,
                   ]);
    }

    /**
     * Get offer by id
     *
     * @param int $id
     * @return JsonResponse
     * @throws JsonException
     */
    public function show(int $id)
    {
        try {
            $offer = $this->offerService->findById($id);
        } catch (ModelNotFoundException $e) {
           abort(404);
        } catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }
       // return  $this->successResponse(__('messages.offer_success'),  ['offer' => $offer],  JsonResponse::HTTP_OK);
        return view('pages.offer-inner')->with('offer', $offer);
    }

    /**
     * Create New Offer
     *
     * @param OfferRequest $offerRequest
     * @return JsonResponse
     * @throws JsonException
     */
    public function store(OfferRequest $offerRequest)
    {
       $data = $offerRequest->validated();

       try {
           $offer = $this->offerService->create($data);
           $offer->user->notify(new OfferCreate());
       } catch(Exception $exception) {
           throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
       }

        return  $this->successResponse(__('messages.offer_success'),  ['offer' => $offer],  JsonResponse::HTTP_OK);
    }

    /**
     * Get All Categories and Districts
     *
     * @param CategoryRepository $categoryRepository
     * @param DistrictRepository $districtRepository
     * @return Factory|View
     */
    public function create(
        CategoryRepository $categoryRepository,
        DistrictRepository $districtRepository
    )
    {
        $categories = $this->categoryRepository->all();
        $districts = $this->districtRepository->all();

        return view('pages.make-offer')
            ->with([
                    'categories' => $categories,
                    'districts' => $districts
                   ]);
    }

    /**
     * Offer edit
     *
     * @param int $id
     * @return Factory|View
     * @throws JsonException
     */
    public function edit(int $id)
    {
        try {
            $offerUpdate = $this->offerService->findById($id);
            $categories = $this->categoryRepository->all();
            $districts = $this->districtRepository->all();
            if($offerUpdate['user_id'] !== Auth::guard($this->guard)->id() ) {
                abort(403, __('auth.access_denied'));
            }
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return view('pages.offer-update')
            ->with([
                    'offer' => $offerUpdate,
                    'categories' => $categories,
                    'districts' => $districts,
                    'id'=>$id
                   ]);
    }

    /**
     * Update offers
     *
     * @param int $id
     * @param UpdateOfferRequest $updateOfferRequest
     * @return JsonResponse
     * @throws JsonException
     */
    public function update(
    int $id,
    UpdateOfferRequest $updateOfferRequest
    )
    {
        $data = $updateOfferRequest->validated();

        try{
            $offer = $this->offerService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new JsonException(__('messages.not_found'), JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            throw new JsonException($e->getMessage(), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successResponse(
            __('messages.success_offer_update'),
            ['offer' => $offer],
            JsonResponse::HTTP_ACCEPTED
        );
    }

    /**
     * Offer like
     *
     * @param OfferLikeRequest $offerLikeRequest
     * @return JsonResponse
     * @throws AlreadyLikedJsonException
     * @throws JsonException
     */
    public function offerLike(OfferLikeRequest $offerLikeRequest)
    {
        $data = $offerLikeRequest->validated();

        try {
            $offerLike = $this->offerService->like($data);
        } catch (ModelNotFoundException $e) {
            throw new JsonException(__('messages.not_found'), JsonResponse::HTTP_NOT_FOUND);
        } catch (AlreadyLikedException $e) {
            throw new AlreadyLikedJsonException($e->getMessage(), $e->getCode());
        }
        catch (Exception $e) {
            throw new JsonException(__('http.service_unavailable'), JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }

        return  $this->successResponse(__('messages.offer_like_success'),  ['offerLike' => $offerLike],  JsonResponse::HTTP_OK);
    }

    /**
     * Offer Search
     *
     * @return Factory|View
     */
    public function offerSearch()
    {
        $offers = $this->offerService->search();
        $categories = $this->categoryRepository->all();
        $districts = $this->districtRepository->all();

        return view('pages.offers')
            ->with([
                    'offers' => $offers,
                    'districts' => $districts,
                    'categories' => $categories,
                   ]);
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|image|mimes:jpeg,png,jpg,bmp'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'Error'
                ],
                400
            );
        }

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $filename = Str::random(20) . '.' . $photo->getClientOriginalExtension();
            $directory =  OfferFile::TYPE_IMAGE;
            $fullPath = $directory . '/' . date('Y-m-d') . '/' . $filename;
            Storage::disk()->put($fullPath, file_get_contents($photo));

            return response()->json(
                [
                    'file_name' => $fullPath
                ]
            );
        }

        return response()->json(
            [
                'message' => ['success']
            ],
            200
        );
    }
}
