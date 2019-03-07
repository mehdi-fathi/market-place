<?php

namespace Apps\Product\Http\Controllers\Api\Seller;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Model\Location;
use Apps\Product\Model\Product;
use Apps\User\Model\Store;
use Apps\User\Model\User;
use Illuminate\Http\Response;
use Request;

class StoresController extends Controller
{
    public function createStore(\Illuminate\Http\Request $request)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        DB::transaction(function () use ($request) {

//            Location::create();

            if(Store::create($request->all())){
                $status = Response::HTTP_CREATED;
            }


        });


        $msg = 'Store has been saved.';
        return ApiOutputMaker::setOutput($msg)->setStatus($status)->getOutput();
    }
}
