<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CharterCapital\CharterCapitalRepositoryInterface;

class CharterCapitalController extends Controller
{
    protected $repository;

    public function __construct(
        CharterCapitalRepositoryInterface $charterCaptial
    )
    {
        $this->repository = $charterCaptial;
    }

    public function index(){
        $dataListCharterCapital = $this->repository->index();
        return response()->success($dataListCharterCapital);
    }
}
