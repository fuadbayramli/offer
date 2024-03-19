<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferFile
 *
 * @package App
 * @author Mahammad Mammadov <codega.az@gmail.com>
 */
class OfferFile extends Model
{
    public const TYPE_IMAGE = 'image';

    /**
     * @var string
     */
    protected $table = 'offer_files';

    /**
     * @var array
     */
    protected $fillable = ['offer_id', 'path'];
}
