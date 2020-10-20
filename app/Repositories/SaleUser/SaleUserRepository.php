<?php

namespace App\Repositories\SaleUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Models\SaleUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
// use App\Repositories\EmailAuth\EmailAuthRepositoryInterface;
use Carbon\Carbon;

class SaleUserRepository implements SaleUserRepositoryInterface
{
    protected $_emailAuth;

    public function __construct()
    {
        // $this->_emailAuth = $emailAuth;
    }

    public function create($email, $name, $password) {
    }
}
