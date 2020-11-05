<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDomain extends Model
{
    use HasFactory;
    protected $table = 't_company_domains';

    protected $fillable = [
        'id', 'domain_id', 'company_id'
    ];
}
