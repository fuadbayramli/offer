<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResultLikeRepository
 *
 * @package App
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class ResultLike extends Model
{
    /**
     * @var string
     */
    protected $table = 'result_likes';

    /**
     * @var array
     */
    protected $fillable = ['result_id', 'user_id'];
}
