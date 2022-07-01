<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function semifinishes()
    {
        return $this->hasMany(Semifinish::class, 'material_id', 'id');
    }

    public function inners()
    {
        return $this->hasMany(Finish::class, 'inner_id', 'id');
    }
}
