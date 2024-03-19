<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class District
 *
 * @package App
 * @author Fuad Bayramli <fuadbayramli94@gmail.com>
 */
class District extends Model
{
    /**
     * @var string
     */
    protected $table = 'districts';

    /**
     * The order value increases dynamically
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order = DB::table('districts')->max('id') + 1;
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
