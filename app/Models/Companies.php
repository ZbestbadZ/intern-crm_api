<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_companies';
    protected $primaryKey = 'id';

    // public $incrementing = false; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_jp', 'name_vn', 'phone', 'fax', 'website', 'address', 'description', 'category_id', 'found_at', 'scale_id', 'charter_capital_id', 'revenue', 'univalence', 
    ]; 

    public function orbit()
    {
        return $this->belongsToMany(Orbit::class, 't_orbit_companies', 'companies_id', 'orbit_id');
    }

    public function sale()
    {
        return $this->belongsToMany(SaleUser::class, 't_sale_companies', 'companies_id', 'sale_user_id');
    }
}
