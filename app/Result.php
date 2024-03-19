<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Result extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'area',
        'district_id',
        'description',
        'status',
        'anonymous',
        'admin_comment',
        'result_images',
        'offer_id',
    ];

    /**
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];

    /**
     * @var array
     */
    protected $appends = ['date_format'];

    /**
     * @return null
     */
//    public function image()
//    {
//        return json_decode($this->result_images, 1)[0] ?? null;
//    }

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
        return $this->hasMany(ResultLike::class, 'result_id', 'id');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id')->where('status', 1);
    }
}
