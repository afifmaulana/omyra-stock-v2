<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function materials()
    {
        return $this->hasMany(Materials::class);
    }
    public function records()
    {
        return $this->hasMany(RecordLog::class, 'product_id', 'id')->where('modelable_type', 'App\Models\Stock')
        ->orderBy('id', 'DESC');
    }
    public function recordsemifinishes()
    {
        return $this->hasMany(RecordLog::class, 'product_id', 'id')->where('modelable_type', 'App\Models\Semifinish')
        ->orderBy('id', 'DESC');
    }
    public function recordfinishes()
    {
        return $this->hasMany(RecordLog::class, 'product_id', 'id')->where('modelable_type', 'App\Models\Finish')
        ->orderBy('id', 'DESC');
    }
}
