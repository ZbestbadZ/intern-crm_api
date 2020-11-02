<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrbitCompanies extends Model
{
    use HasFactory;

    protected $table = 't_orbit_companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'orbit_id', 'companies_id'
    ];
}
