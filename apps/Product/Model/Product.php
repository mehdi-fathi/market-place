<?php

namespace Apps\Product\Model;

use Apps\User\Model\Market;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_id',
        'title',
        'description',
        'price',
        'discount',
    ];
    public function markets()
    {
        return $this->hasOne(Market::class);
    }
}
