<?php

namespace Apps\User\Http\Controllers\Api;

use App\Facades\ApiOutputMaker;
use Apps\User\Http\Requests\StoreRegisterUser;
use Apps\User\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Apps\User\Model\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(StoreRegisterUser $request)
    {
        $request->merge(['role_id' => Role::getIdByRole('Customer')]);
        $input = $request->all();
        $user = User::create($input);
        $success['token'] = $user->createToken('AppName')->accessToken;

        return ApiOutputMaker::setOutput($success)->getOutput();
    }


    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('AppName')->accessToken;
            return ApiOutputMaker::setOutput($success)->getOutput();
        } else {

            return ApiOutputMaker::setOutput(['error' => 'Unauthorised'])
                ->gsetStatus(401)
                ->getOutput();
        }
    }

    public function getUser()
    {
        $user = ['user' => Auth::user()];
        return ApiOutputMaker::setOutput($user)->getOutput();
    }
}
