<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferVideo
 *
 * @package App
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class OfferVideo extends Model
{
    public const TYPE_VIDEO = 'video';

    /**
     * @var string
     */
    protected $table = 'offer_videos';

    /**
     * @var array
     */
    protected $fillable = ['offer_id', 'path'];
}
