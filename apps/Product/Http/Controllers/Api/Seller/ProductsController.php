<?php

namespace Apps\Product\Http\Controllers\Api\Seller;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Http\Requests\StoreProduct;
use Apps\Product\Model\Product;
use Illuminate\Http\Response;
use Request;

class ProductsController extends Controller
{
    public function create(StoreProduct $request)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if (Product::create($request->all())) {
            $status = Response::HTTP_CREATED;
        }

        return ApiOutputMaker::setOutput(trans('product::msg.save_product'))
            ->setStatus($status)
            ->getOutput();
    }

}
