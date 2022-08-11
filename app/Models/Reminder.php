<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'material_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
