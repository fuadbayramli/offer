<?php

namespace App\Http\Repositories\Result;

use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\RepositoryInterface;
use App\Result;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ResultRepository
 *
 * @package App\Http\Repositories\Result
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultRepository extends BaseRepository
{
    /**
     * ResultRepository constructor.
     *
     * @param Result $model
     */
      public function __construct(Result $model)
      {
          parent::__construct($model);
      }

    /**
     * Get result by id
     *
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|mixed
     */
      public function show(int $id)
      {
          return $this->model->with('user', 'offer')
                             ->where('status', 1)
                             ->findOrFail($id)
                             ->toArray();
      }

      public function all(array $params = [])
      {
          $limit = $params['limit'] ?? RepositoryInterface::ALL_METHOD_LIMIT;
          $results = $this->model->limit($limit)->where('status', 1)->withCount('likes')->orderBY('id', 'DESC')->get()->toArray();

          if (!$results) {
              return null;
          }

          return $results;
      }

    /**
     * @param array $where
     * @return mixed|null
     */
      public function findByWhere(array $where = [])
      {
          $limit = $params['limit'] ?? RepositoryInterface::ALL_METHOD_LIMIT;
          $results = $this->model->limit($limit)
              ->where($where)
              ->where('status', 1)
              ->withCount('likes')
              ->orderBY('id', 'DESC')
              ->get()
              ->toArray();

          if (!$results) {
              return null;
          }

          return $results;
      }
}
