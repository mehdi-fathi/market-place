<?php

namespace Apps\User\Model;

use Apps\Product\Model\Location;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->attributes['user_id'])) {
                $model->attributes['user_id'] = auth()->id();
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function locations()
    {
        return $this->belongsTo(Location::class,'location_id');
    }

}
