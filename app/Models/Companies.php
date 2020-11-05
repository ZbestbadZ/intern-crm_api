<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_companies';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_jp', 'name_vn', 'phone', 'fax', 'website', 'address', 'description', 'category', 'established_at', 'scale', 'fonds', 'revenue', 'unit_price', 
    ]; 

    public function domains()
    {
        return $this->belongsToMany(Domain::class, 't_company_domains', 'company_id', 'domain_id');
    }

    public function sales()
    {
        return $this->belongsToMany(SaleUser::class, 't_sale_company', 'company_id', 'sale_user_id');
    }
}
