<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'm_domains';

    protected $appends = ['label', 'value'];

    protected $visible = ['id', 'label', 'value'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description'
    ];

    public function getLabelAttribute()
    {
        return $this->name;
    }

    public function getValueAttribute()
    {
        return $this->id;
    }
    
    public function companies()
    {
        return $this->belongsToMany(Companies::class, 't_domains_companies',  'domains_id', 'companies_id');
    }
}
