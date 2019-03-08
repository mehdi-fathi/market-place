<?php

namespace Apps\Product\Http\Controllers\Api\Customer;

use App\Facades\ApiOutputMaker;
use App\Http\Controllers\Controller;
use Apps\Product\Http\Requests\StorePayment;
use Apps\Product\Model\Payment;
use Illuminate\Http\Response;
use Request;

class PaymentsController extends Controller
{
    private $_payment_model;

    public function __construct(Payment $payment)
    {
        $this->_payment_model = $payment;
    }

    public function productBuy(StorePayment $request)
    {

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        $request->merge(['status' => 2]);

        if ($this->_payment_model->create($request->all())) {

            $status = Response::HTTP_CREATED;
        }

        return ApiOutputMaker::setOutput('Payment has been successfully.')
            ->setStatus($status)
            ->getOutput();
    }

}
