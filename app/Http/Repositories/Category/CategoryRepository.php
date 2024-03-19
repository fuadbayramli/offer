<?php

namespace App\Http\Repositories\Category;

use App\Category;
use App\Http\Repositories\BaseRepository;

/**
 * Class CategoryRepository
 *
 * @package App\Http\Repositories\Category
 * @author Mahammad Mammadov <codega.az@gmaqil.com>
 */
class CategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param Category $model
     */
   public function __construct(Category $model)
   {
       parent::__construct($model);
   }

    /**
     * Get all categories
     *
     * @param array $params
     * @return mixed|null
     */
   public function all(array $params =[])
   {
       $categories = $this->model->orderBy('order')->get();

       if (!$categories) {
           return null;
       }

       return $categories;
   }
}
