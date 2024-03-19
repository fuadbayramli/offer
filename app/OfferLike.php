<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferLikeRepository
 *
 * @package App
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferLike extends Model
{
    /**
     * @var string
     */
    protected $table = 'offer_likes';

    /**
     * @var array
     */
    protected $fillable = ['offer_id', 'user_id'];
}
