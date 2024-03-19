<?php

namespace App\Http\Repositories\Offer;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\RepositoryInterface;
use App\OfferFile;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferFileRepository
 *
 * @package App\Http\Repositories\Offer
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferFileRepository extends BaseRepository
{
    /**
     * OfferFileRepository constructor.
     *
     * @param OfferFile $model
     */
   public function __construct(OfferFile $model)
   {
       parent::__construct($model);
   }

}
