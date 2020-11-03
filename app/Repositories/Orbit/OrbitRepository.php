<?php

namespace App\Repositories\Orbit;

use App\Models\Orbit;
use App\Repositories\Orbit\OrbitRepositoryInterface;
use Carbon\Carbon;


class OrbitRepository implements OrbitRepositoryInterface
{
    public function index() {
        $dataListOrbit = Orbit::select('id','name','description')->get();
        return [
            'list_orbit ' => $dataListOrbit
        ];
    }

  
}
