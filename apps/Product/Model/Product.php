<?php

namespace Apps\Product\Model;

use Apps\User\Model\Market;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsTo(Market::class, 'market_id');
    }

    public function find_by_near($location_user,$distance)
    {
        return $this->whereHas('markets', function ($query) use ($location_user,$distance) {

            $query->whereHas('locations', function ($query) use ($location_user,$distance) {

                $latitude = $location_user['latitude'];
                $longitude = $location_user['longitude'];

                $query->whereRaw(DB::raw("(3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) )  *
                         cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(
                         radians( latitude ) ) ) ) < $distance "));
            });
        })->get();
    }
}
