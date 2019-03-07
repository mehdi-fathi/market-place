<?php

namespace Apps\User\Model;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'store',
        'description',
        'location_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
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
        return $this->belongsTo(Location::class);
    }

}
