<?php

namespace App\Http\Controllers\Admin\Voyager;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Offer\OfferFileRepository;
use Illuminate\Http\RedirectResponse;

/**
 * Class OfferImageController
 *
 * @package App\Http\Controllers\Admin\Voyager
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferImageController extends Controller
{
    /**
     * @var OfferFileRepository
     */
   protected $offerFileRepository;

    /**
     * OfferImageController constructor.
     *
     * @param OfferFileRepository $offerFileRepository
     */
   public function __construct(OfferFileRepository $offerFileRepository)
   {
       $this->offerFileRepository = $offerFileRepository;
   }

    /**
     * Delete offer image
     * @param int $id
     *
     * @return RedirectResponse
     */
   public function destroy(int $id)
   {
     $this->offerFileRepository->delete($id);

     return back();
   }
}
