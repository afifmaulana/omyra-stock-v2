<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(Materials::class, 'material_id', 'id');
    }
    public static function startYearFilter()
    {
        return Carbon::now()->subYears(2)->format('Y');
    }

    public static function endYearFilter()
    {
        return Carbon::now()->addYears(10)->format('Y');
    }
    public static function months()
    {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'];
    }

    public function records()
    {
        return $this->morphMany(RecordLog::class, 'modelable');
    }
}
