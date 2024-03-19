<?php

namespace App\Http\Repositories\Result;

use App\Http\Repositories\BaseRepository;
use App\ResultLike;

/**
 * Class ResultLikeRepository
 * @package App\Http\Repositories\Result
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultLikeRepository extends BaseRepository
{
    public function __construct(ResultLike $model)
    {
        parent::__construct($model);
    }

}
