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
        'id', 'name_jp', 'name_vn', 'phone', 'fax', 'website', 'address', 'description', 'category_enum', 'established_at', 'scale_enum', 'fonds_enum', 'revenue', 'unit_price', 
    ]; 

    public function domains()
    {
        return $this->belongsToMany(Domain::class, 't_domains_companies', 'companies_id', 'domains_id');
    }

    public function sales()
    {
        return $this->belongsToMany(SaleUser::class, 't_sale_companies', 'companies_id', 'sale_user_id');
    }
}
