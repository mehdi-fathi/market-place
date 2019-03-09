<?php

namespace Apps\Product\Http\Controllers\Api\Seller;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Http\Requests\StoreMarket;
use Apps\Product\Model\Location;
use Apps\User\Model\Market;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Request;

class MarketsController extends Controller
{
    public function create(StoreMarket $request)
    {
        $status = DB::transaction(function () use ($request) {

            $newLocation = Location::create($request->all());

            $request->merge(['location_id' => $newLocation->id]);

            $newMarket = Market::create($request->all());

            if (!$newMarket) {
                throw new \Exception(trans('product::msg.save_market_exception'));
            }
            $status = Response::HTTP_CREATED;

            return $status;

        }, 2);

        return ApiOutputMaker::setOutput(trans('product::msg.save_market'))
            ->setStatus($status)
            ->getOutput();
    }
}
