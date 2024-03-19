<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Offer\OfferRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class MainController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class MainController extends Controller
{
    private const OFFER_MAIN_LIMIT = 6;
    /**
     * @var OfferRepository
     */
    protected $offerRepository;

    /**
     * MainController constructor.
     *
     * @param OfferRepository $offerRepository
     */
    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @return Factory|View
     */
    public function mainOffers()
    {
        $params['limit'] = self::OFFER_MAIN_LIMIT;
        $mainOffers = $this->offerRepository->all($params);

        return view('pages.main')->with('mainOffers', $mainOffers);
    }
}
