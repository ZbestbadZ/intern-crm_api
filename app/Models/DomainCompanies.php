<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainCompanies extends Model
{
    use HasFactory;
    protected $table = 't_domains_companies';

    protected $fillable = [
        'id', 'domains_id', 'companies_id'
    ];
}
