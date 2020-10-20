<?php

namespace App\Http\Controllers\Api;

use Config;
use App\Models\SaleUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\SaleUserRequest;
use App\Repositories\SaleUser\SaleUserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SaleUserController extends Controller
{
    protected $saleUser;

    public function __construct(
        SaleUserRepositoryInterface $saleUser
    )
    {
        $this->saleUser = $saleUser;
    }


    public function create(SaleUserRequest $request)
    {
        echo 'create user';
    }
}
