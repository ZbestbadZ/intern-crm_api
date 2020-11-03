<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index() {
        $dataListCategory = Category::with('options')->where('parent_id', Category::PARENT_CATEGORY)->get();
        if(!empty($dataListCategory)){
            foreach($dataListCategory as $v){
               if($v['options']->count() == 0){
                    $v['options'][] = [
                        'id' => $v['id'],
                        'label' => $v['label'],
                        'value' => $v['value'],
                    ];
               }
            }
        }
        return [
            'list_category ' => $dataListCategory
        ];
    }


}
