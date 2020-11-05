<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;
    protected $table = 'm_domains';

    protected $fillable = [
        'id', 'name', 'description'
    ]; 

    public function companies()
    {
        return $this->belongsToMany(Companies::class, 't_domains_companies', 'domains_id', 'companies_id');
    }

}
