<?php

namespace Apps\Product\Http\Controllers\Api\Customer;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Model\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Request;

class ProductsController extends Controller
{
    private $_product_model;

    public function __construct(Product $product)
    {
        $this->_product_model = $product;
    }

    public function findNear(\Illuminate\Http\Request $request)
    {
        $status = Response::HTTP_OK;

        $radius = 50;

        $location_user = Auth::user()->locations()->first();

        if (!empty($request->get('radius'))) {

            $radius = $request->get('radius');
        }

        $products_near = $this->_product_model->find_by_near($location_user, $radius)->toArray();

        return ApiOutputMaker::setOutput($products_near)
            ->setStatus($status)
            ->getOutput();
    }

}
