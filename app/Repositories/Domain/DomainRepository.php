<?php

namespace App\Repositories\Domain;

use App\Models\Domain;
use App\Repositories\Domain\DomainRepositoryInterface;

class DomainRepository implements DomainRepositoryInterface
{
    public function index() {
        $dataListDomain = Domain::all();
        return $dataListDomain;
    }

  
}
