<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Faq
 *
 * @package App
 * @author Mahammad Mamadov <codega.az@gnail.com>
 */
class Faq extends Model
{
    /**
     * @var string
     */
    protected $table = 'faqs';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'order'];

    /**
     * The order value increases dynamically
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order = DB::table('faqs')->max('id') + 1;
        });
    }
}
