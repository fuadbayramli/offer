<?php

namespace App\Http\Repositories\Offer;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\RepositoryInterface;
use App\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferRepository
 *
 * @package App\Http\Repositories\Offer
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferRepository extends BaseRepository
{
    /**
     * OfferRepository constructor.
     *
     * @param Offer $model
     */
      public function __construct(Offer $model)
      {
          parent::__construct($model);
      }

    /**
     * Get offer by id
     *
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|mixed
     */
      public function show(int $id)
      {
          return $this->model->with('images', 'videos', 'user', 'result')
                             ->where('status', 1)
                             ->findOrFail($id)
                             ->toArray();
      }

      public function all(array $params = [])
      {
          $limit = $params['limit'] ?? RepositoryInterface::ALL_METHOD_LIMIT;
          $offers = $this->model->limit($limit)->where('status', 1)->with('image', 'video', 'user')->withCount('likes')->orderBY('id', 'DESC')->get()->toArray();

          if (!$offers) {
              return null;
          }

          return $offers;
      }

    /**
     * @param array $where
     * @return mixed|null
     */
      public function findByWhere(array $where = [])
      {
          $limit = $params['limit'] ?? RepositoryInterface::ALL_METHOD_LIMIT;
          $offers = $this->model->limit($limit)
              ->where($where)
              ->where('status', 1)
              ->with('image', 'video', 'user')
              ->withCount('likes')
              ->orderBY('id', 'DESC')
              ->get()
              ->toArray();

          if (!$offers) {
              return null;
          }

          return $offers;
      }
}
