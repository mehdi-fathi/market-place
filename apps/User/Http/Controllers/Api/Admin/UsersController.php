<?php

namespace Apps\User\Http\Controllers\Api\Admin;

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

class UsersController extends Controller
{
    public function createSeller(StoreRegisterUser $request)
    {
        $status = DB::transaction(function () use ($request) {

            $newLocation = Location::create($request->all());

            $request->merge(['location_id' => $newLocation->id]);
            $request->merge(['role_id' => Role::getIdByRole('Seller')]);

            $input = $request->all();

            $msg = 'error';
            $newUser = User::create($input);
            if (!$newUser) {
                throw new \Exception('Store not created for account');
            }
            return Response::HTTP_CREATED;

        }, 2);

        $msg = 'user has been saved.';
        return ApiOutputMaker::setOutput($msg)->setStatus($status)->getOutput();
    }
}
