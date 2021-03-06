<?php

namespace Apps\Product\Model;

use Apps\User\Model\Market;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'address',
        'city',
    ];
    public function markets()
    {
        return $this->hasOne(Market::class);
    }
}
