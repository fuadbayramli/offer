<?php

namespace App\Http\Controllers\Admin\Voyager;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Offer\OfferVideoRepository;
use Illuminate\Http\RedirectResponse;

/**
 * Class OfferVideoController
 *
 * @package App\Http\Controllers\Admin\Voyager
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class OfferVideoController extends Controller
{
    /**
     * @var OfferVideoRepository
     */
   protected $offerVideoRepository;

    /**
     * OfferImageController constructor.
     *
     * @param OfferVideoRepository $offerVideoRepository
     */
   public function __construct(OfferVideoRepository $offerVideoRepository)
   {
       $this->offerVideoRepository = $offerVideoRepository;
   }

    /**
     * Delete offer video
     * @param int $id
     *
     * @return RedirectResponse
     */
   public function destroy(int $id)
   {
     $this->offerVideoRepository->delete($id);

     return back();
   }
}
