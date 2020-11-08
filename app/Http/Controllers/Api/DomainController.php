<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Domain\DomainRepositoryInterface;

class DomainController extends Controller
{
    protected $repository;

    public function __construct(
        DomainRepositoryInterface $domain
    )
    {
        $this->repository = $domain;
    }

    public function index(){
        $dataListDomain = $this->repository->index();
        return response()->success($dataListDomain);
    }
}
