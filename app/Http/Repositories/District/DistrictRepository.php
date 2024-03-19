<?php

namespace App\Http\Repositories\District;

use App\District;
use App\Http\Repositories\BaseRepository;

/**
 * Class DistrictRepository
 *
 * @package App\Http\Repositories\District
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class DistrictRepository extends BaseRepository
{
    /**
     * DistrictRepository constructor.
     *
     * @param District $model
     */
   public function __construct(District $model)
   {
       parent::__construct($model);
   }

    /**
     * Get all districts
     *
     * @param array $params
     * @return mixed|null
     */
   public function all(array $params =[])
   {
       $districts = $this->model->orderBy('order')->get();

       if (!$districts) {
           return null;
       }

       return $districts;
   }
}
