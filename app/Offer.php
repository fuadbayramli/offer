<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Offer
 *
 * @package App
 *
 *
 */
class Offer extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'category_id', 'user_id', 'area', 'district_id', 'description', 'status', 'anonymous', 'admin_comment'
    ];

    /**
     * @var array
     */
    protected $hidden = ['updated_at', 'deleted_at', 'created_at'];

    /**
     * @var array
     */
    protected $appends = ['date_format'];

    public $additional_attributes = ['full_name'];

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        $firstPart = $this->getAttribute('title');
        $secondPart = $this->user->getAttribute('name');
        $thirdPart = $this->user->getAttribute('surname');

        return $firstPart . ' - ' . $secondPart.' '.$thirdPart;
    }

    /**
     * @return HasOne
     */
    public function image(): HasOne
    {
       return  $this->hasOne(OfferFile::class, 'offer_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return  $this->hasMany(OfferFile::class, 'offer_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function video(): HasOne
    {
        return  $this->hasOne(OfferVideo::class, 'offer_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return  $this->hasMany(OfferVideo::class, 'offer_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(SiteUser::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    /**
     * @return string
     */
    public function getDateFormatAttribute(): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }

    /**
     * @return HasMany
     */
    public function likes()
    {
        return $this->hasMany(OfferLike::class, 'offer_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function result()
    {
        return $this->hasOne(Result::class, 'offer_id', 'id')->where('status', 1);
    }

}
