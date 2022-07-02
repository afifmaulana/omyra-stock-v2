<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function saveRecord($data)
    {
        self::create($data);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function material()
    {
        return $this->belongsTo(Materials::class, 'material_id');
    }
}
