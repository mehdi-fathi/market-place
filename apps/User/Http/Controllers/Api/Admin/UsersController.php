<?php

namespace Apps\User\Http\Controllers\Api\Admin;

use App\Facades\ApiOutputMaker;
use Apps\User\Http\Requests\StoreRegisterUser;
use Apps\User\Model\Product;
use App\Http\Controllers\Controller;
use Apps\User\Model\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{
    public function createSeller(StoreRegisterUser $request)
    {

        $request->merge(['role_id' => Product::getIdByRole('Seller')]);
        $input = $request->all();

        $msg = 'error';
        if(User::create($input)){
            $msg = 'user has been saved.';
            return ApiOutputMaker::setOutput($msg)->getOutput();
        }

        return ApiOutputMaker::setOutput($msg)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->getOutput();
    }
}
