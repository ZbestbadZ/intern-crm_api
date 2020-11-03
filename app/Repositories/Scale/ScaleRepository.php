<?php

namespace App\Repositories\Scale;

use App\Models\Scale;
use App\Repositories\Scale\ScaleRepositoryInterface;


class ScaleRepository implements ScaleRepositoryInterface
{
    public function index() {
        $dataListScale = Scale::select('id','name')->get();
        return [
            'list_scale ' => $dataListScale
        ];
    }

  
}
