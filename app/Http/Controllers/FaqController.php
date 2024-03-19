<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Faq\FaqRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class FaqController
 *
 * @package App\Http\Controllers
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class FaqController extends Controller
{
    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * FaqController constructor.
     *
     * @param FaqRepository $faqRepository
     */
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Get all faqs
     *
     * @return Factory|View
     */
    public function all()
    {
        $faqs = $this->faqRepository->all();

        return view('pages.faqs')->with('faqs', $faqs);
    }
}
