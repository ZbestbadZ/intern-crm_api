<?php

namespace App\Repositories\CharterCapital;

use App\Models\CharterCapital;
use App\Repositories\CharterCapital\CharterCapitalRepositoryInterface;


class CharterCapitalRepository implements CharterCapitalRepositoryInterface
{
    public function index() {
        $dataListCharterCapital = CharterCapital::select('id','name')->get();
        return [
            'list_charter_captial ' => $dataListCharterCapital
        ];
    }

  
}
