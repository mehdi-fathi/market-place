<?php

namespace Apps\Product\Http\Controllers\Api\Seller;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Model\Location;
use Apps\User\Model\Market;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Request;

class MarketsController extends Controller
{
    public function createStore(\Illuminate\Http\Request $request)
    {

        $status = DB::transaction(function () use ($request) {

            $newLocation = Location::create($request->all());

            $request->merge(['location_id' => $newLocation->id]);

            $newStore = Market::create($request->all());

            if (!$newStore) {
                throw new \Exception('Store not created for account');
            }
            $status = Response::HTTP_CREATED;

            return $status;

        }, 2);

        return ApiOutputMaker::setOutput(trans('product::msg.save_market'))
            ->setStatus($status)
            ->getOutput();
    }
}