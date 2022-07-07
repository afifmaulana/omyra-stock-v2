<?php

namespace Database\Seeders;

use App\Models\Materials;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Product_id 1
        Materials::create([
            'product_id' => 1,
            'name' => 'RZA',
            'type' => 'plastic',
            'stock' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Materials::create([
            'product_id' => 1,
            'name' => 'RZA',
            'type' => 'inner',
            'stock' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Materials::create([
            'product_id' => 1,
            'name' => 'RZA',
            'type' => 'master',
            'stock' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //Product_id 2
        // Materials::create([
        //     'product_id' => 2,
        //     'name' => 'RZA',
        //     'type' => 'plastic',
        //     'stock' => '0',
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
        Materials::create([
            'product_id' => 2,
            'name' => 'RZA',
            'type' => 'inner',
            'stock' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Materials::create([
            'product_id' => 2,
            'name' => 'RZA',
            'type' => 'master',
            'stock' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);



            Materials::create([
                'product_id' => 1,
                'name' => ['RZA', 'RZA', 'RZA'],
                'type' => ['plastic', 'inner', 'master'],
                'stock' => '0',
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            Materials::create([
                'product_id' => 2,
                'name' => 'RZA GASTRO',
                'type' => ['plastic', 'master'],
                'stock' => '0',
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            Materials::create([
                'product_id' => 3,
                'name' => ['BLACK', 'BLACK NEW SHAPE', 'BLACK NEW SHAPE'],
                'type' => ['plastic', 'inner', 'master'],
                'stock' => '0',
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            Materials::create([
                'product_id' => 5,
                'name' => ['RZA 1,25', 'RZA 1,25', 'RZA 12,5'],
                'type' => ['plastic', 'inner', 'master'],
                'stock' => '0',
                'user_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);


    }
}
