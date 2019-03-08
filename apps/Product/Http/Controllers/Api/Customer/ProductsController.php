<?php

namespace Apps\Product\Http\Controllers\Api\Customer;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Http\Requests\StoreProduct;
use Apps\Product\Model\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Request;

class ProductsController extends Controller
{
    public function findNear(\Illuminate\Http\Request $request)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

//        dd(Auth::user()->locations()->first());

        $location_user = Auth::user()->locations()->first();

//        dd($location_user);

        $product = new Product();

        $ss = Product::whereHas('markets', function ($query) use ($location_user) {

            $query->whereHas('locations', function ($query) use ($location_user) {

                $latitude = $location_user['latitude'];
                $longitude = $location_user['longitude'];

                $query->whereRaw(DB::raw("(3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) )  *
                         cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(
                         radians( latitude ) ) ) ) < 100 "));
            });
        })->get();

        dd($ss);

        if (Product::create($request->all())) {
            $status = Response::HTTP_CREATED;
        }

        return ApiOutputMaker::setOutput(trans('product::msg.save_product'))
            ->setStatus($status)
            ->getOutput();
    }

}
