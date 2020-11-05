<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCompany extends Model
{
    use HasFactory;

    protected $table = 't_sale_company';

    protected $fillable = [
        'id', 'sale_user_id', 'company_id'
    ];

}
