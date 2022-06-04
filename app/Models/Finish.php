<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function inner()
    {
        return $this->belongsTo(Materials::class, 'inner_id');
    }

    public function master()
    {
        return $this->belongsTo(Materials::class, 'master_id');
    }
}
