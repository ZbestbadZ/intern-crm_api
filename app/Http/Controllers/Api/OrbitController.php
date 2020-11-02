<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Orbit\OrbitRepositoryInterface;

class OrbitController extends Controller
{
    protected $repository;

    public function __construct(
        OrbitRepositoryInterface $orbit
    )
    {
        $this->repository = $orbit;
    }

    public function index(Request $request){

    }

}
