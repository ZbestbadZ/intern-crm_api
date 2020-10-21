<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Config;
use App\Models\SaleUser;
use App\Models\EmailAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\SaleUserRequest;
use App\Repositories\SaleUser\SaleUserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SaleUserController extends Controller
{
    protected $_saleUser;

    public function __construct(
        SaleUserRepositoryInterface $saleUser
    )
    {
        $this->_saleUser = $saleUser;
    }

    public function create(SaleUserRequest $request)
    {
        $data = $request->all();
        try {
            $newUser = $this->_saleUser->create($data['email'], $data['password']);
            return response()->success([
                'message' => 'Create User Success'
            ]);
        } catch (\Exception $e) {
            return response()->error([
                'message' => 'A system error has occurred.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR,);
        }
    }

    public function checkExpiration(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'token'   => 'required'
        ],
        [
            'token.required' => 'Please enter the token.',
        ]
        );
        if ($validator->fails()) {
            return response()->json([
                'error' =>  $validator->errors(),
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($userId = $this->_saleUser->verifyToken($data['token'])) {
            return response()->success([
                'message' => 'Success to Authenticate',
                'userId' => $userId,
            ], Response::HTTP_OK);
        }

        return response()->error([
            'message' => 'Failed to Authenticate'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
