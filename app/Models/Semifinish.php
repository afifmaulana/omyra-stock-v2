<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semifinish extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'material_id');
    }
    
    public function materials()
    {
        return $this->hasMany(Materials::class);
    }
}
