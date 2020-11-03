<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;


class CategoryController extends Controller
{
    protected $repository;

    public function __construct(
        CategoryRepositoryInterface $category
    )
    {
        $this->repository = $category;
    }

    public function index(){
        $dataListCategory = $this->repository->index();
        return response()->success($dataListCategory);
    }
}
