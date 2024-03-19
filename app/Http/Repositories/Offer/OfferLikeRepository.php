<?php

namespace App\Http\Repositories\Offer;

use App\Http\Repositories\BaseRepository;
use App\OfferLike;

/**
 * Class OfferLikeRepository
 * @package App\Http\Repositories\Offer
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferLikeRepository extends BaseRepository
{
    public function __construct(OfferLike $model)
    {
        parent::__construct($model);
    }

}
