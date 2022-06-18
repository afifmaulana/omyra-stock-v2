<?php

namespace Database\Seeders;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => ['ALDUCHAN','BABYLON', 'FLARE', 'COCO PRO', 'AZWAN', 'MOESKOHLE', 'COCO ORIGINAL', 'AMIR FOOD', 'GOLDEN NUGGET', 'COCO Q'],
            'user_id' => 1,
            'created_at' => Carbon::now()->format('yyyy-mm-dd'),
            'updated_at' => Carbon::now()->format('yyyy-mm-dd'),
        ]);
    }
}
