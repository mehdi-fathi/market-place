<?php

namespace Apps\Product\Model;

use Apps\User\Model\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'value',
        'status',
        'transaction_hash',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->attributes['user_id'])) {
                $model->attributes['user_id'] = auth()->id();
            }
            $model->attributes['transaction_hash'] = bcrypt(time());
        });
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
