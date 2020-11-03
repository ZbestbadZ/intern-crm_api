<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index() {
        $dataListCategory = Category::select('id', 'name')->with('children:id,name,parent_id')->where('parent_id', Category::PARENT_CATEGORY)->get();
        return [
            'list_category ' => $dataListCategory
        ];
    }
}
