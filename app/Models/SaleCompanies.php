<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCompanies extends Model
{
    use HasFactory;
    protected $table = 't_sale_companies';

    protected $fillable = [
        'id', 'sale_user_id', 'companies_id'
    ];
}
