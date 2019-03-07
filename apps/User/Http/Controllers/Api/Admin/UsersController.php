<?php

namespace Apps\User\Http\Controllers\Api\Admin;

use App\Facades\ApiOutputMaker;
use Apps\User\Http\Requests\StoreRegisterUser;
use Apps\User\Model\Role;
use App\Http\Controllers\Controller;
use Apps\User\Model\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{
    public $successStatus = Response::HTTP_OK;

    public function createSeller(StoreRegisterUser $request)
    {
        $request->merge(['role_id' => Role::getIdByRole('Seller')]);
        $input = $request->all();

        $msg = 'error';
        if(User::create($input)){
            $msg = 'user has been saved.';
            return ApiOutputMaker::setOutput($msg)->getOutput();
        }

        return ApiOutputMaker::setOutput($msg)->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->getOutput();
    }

    public function login()
    {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')])) {

            $user = Auth::user();
            $success['token'] = $user->createToken('AppName')->accessToken;
            return ApiOutputMaker::setOutput($success)->getOutput();

        } else {

            return ApiOutputMaker::setOutput(['error' => 'Unauthorised'])
                ->setStatus(401)
                ->getOutput();
        }
    }

    public function getUser()
    {
        $user = ['user' => Auth::user()];
        return ApiOutputMaker::setOutput($user)->getOutput();
    }
}
