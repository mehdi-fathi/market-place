<?php

namespace Apps\Product\Http\Controllers\Api\Seller;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Model\Product;
use Apps\User\Model\User;
use Illuminate\Http\Response;
use Request;

class ProductsController extends Controller
{
    public function createProduct(\Illuminate\Http\Request $request)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if (Product::create($request->all())) {
            $status = Response::HTTP_CREATED;
        }

        $msg = 'Product has been saved.';
        return ApiOutputMaker::setOutput($msg)->setStatus($status)->getOutput();
    }


}
