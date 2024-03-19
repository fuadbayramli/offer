<?php

namespace App\Http\Repositories\Faq;

use App\Faq;
use App\Http\Repositories\BaseRepository;

/**
 * Class FaqRepository
 *
 * @package App\Http\Repositories\Faq
 * @author  Mahammad Mammadov <codega.az@gmail.com>
 */
class FaqRepository extends BaseRepository
{
    /**
     * FaqRepository constructor.
     *
     * @param Faq $model
     */
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }
}
