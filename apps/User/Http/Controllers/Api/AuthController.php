<?php

namespace Apps\User\Http\Controllers\Api;

use App\Facades\ApiOutputMaker;
use Apps\Product\Model\Location;
use Apps\User\Http\Requests\StoreRegisterUser;
use Apps\User\Model\Product;
use App\Http\Controllers\Controller;
use Apps\User\Model\Role;
use Apps\User\Model\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends Controller
{
    public $successStatus = Response::HTTP_OK;

    public function register(StoreRegisterUser $request)
    {

        $success = DB::transaction(function () use ($request) {

            $newLocation = Location::create($request->all());

            $request->merge(['location_id' => $newLocation->id]);
            $request->merge(['role_id' => Role::getIdByRole('Customer')]);

            $input = $request->all();

            $user = User::create($input);

            $success['token'] = $user->createToken('AppName')->accessToken;
            return $success;

        }, 2);

        return ApiOutputMaker::setOutput($success)->getOutput();
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

            return ApiOutputMaker::setOutput(['error' => trans('user::msg.error_login')])
                ->setStatus(401)
                ->getOutput();
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return ApiOutputMaker::setOutput(['msg' => trans('user::msg.logout')])
                ->setStatus(200)
                ->getOutput();
        }
    }

    public function getUser()
    {
        $user = ['user' => Auth::user()];
        return ApiOutputMaker::setOutput($user)->getOutput();
    }
}
