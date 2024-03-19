<?php

namespace App\Http\Repositories\Offer;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\RepositoryInterface;
use App\OfferVideo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferVideoRepository
 *
 * @package App\Http\Repositories\Offer
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class OfferVideoRepository extends BaseRepository
{
    /**
     * OfferFileRepository constructor.
     *
     * @param OfferVideo $model
     */
   public function __construct(OfferVideo $model)
   {
       parent::__construct($model);
   }

}
