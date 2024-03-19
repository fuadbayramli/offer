<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class Category
 *
 * @package App
 * @author Mahammad Masmmadov <codega.az@gmail.com>
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * The order value increases dynamically
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order = DB::table('categories')->max('id') + 1;
        });
    }

    /**
     * @return HasMany
     */
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}
