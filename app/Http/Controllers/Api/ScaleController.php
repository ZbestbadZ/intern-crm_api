<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Scale\ScaleRepositoryInterface;


class ScaleController extends Controller
{
    protected $repository;

    public function __construct(
        ScaleRepositoryInterface $orbit
    )
    {
        $this->repository = $orbit;
    }

    public function index(){
        $dataListScale = $this->repository->index();
        return response()->success($dataListScale);
    }
}
