<?php

namespace Apps\Product\Model;

use Apps\User\Model\Store;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'title',
        'description',
        'price',
        'discount',
    ];
    public function stores()
    {
        return $this->hasOne(Store::class);
    }
}
