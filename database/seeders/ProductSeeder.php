<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Brand ALDUCHAN
        Product::create([
            'brand_id' => 1,
            'size' => '1 KG 2,6',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '1 KG 2,6 NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '1 KG 2,8',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '1 KG 2,8 NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '1,25 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '1,25 KG NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '3 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '3 KG NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 1,
            'size' => '18,75 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //Brand BABYLON
        Product::create([
            'brand_id' => 2,
            'size' => '20 KG 2,6 NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '20',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 2,
            'size' => 'CURAH 2,6 NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 2,
            'size' => '20 KG 2,5 NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '20',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //Brand FLARE
        Product::create([
            'brand_id' => 3,
            'size' => '6x2 (12KG)',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '6',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 3,
            'size' => '9 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '24',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 3,
            'size' => '1 KG CURAH 2,6',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //BRAND COCO PRO
        Product::create([
            'brand_id' => 4,
            'size' => 'CURAH',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 4,
            'size' => '10 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //BRAND AZWAN
        Product::create([
            'brand_id' => 5,
            'size' => '10 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 5,
            'size' => '10 KG CURAH',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '0',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //BRAND MOESKOHLE
        Product::create([
            'brand_id' => 6,
            'size' => '20 KG 26,5 NEW',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '20',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 6,
            'size' => '10 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 6,
            'size' => '10 KG CURAH',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //BRAND COCO ORIGINAL
        Product::create([
            'brand_id' => 7,
            'size' =>  '1 KG',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //BRAND AMIR FOOD
        Product::create([
            'brand_id' => 8,
            'size' => '20 KG 2,6',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '20',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 8,
            'size' => '1KG & 1/2 KG 2,5 ',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '20',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //BRAND COCO Q
        Product::create([
            'brand_id' => 10,
            'size' => '2,2',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        Product::create([
            'brand_id' => 10,
            'size' => '2,5 ',
            'stock_semifinish' => '0',
            'stock_finish' => '0',
            'need_inner' => '10',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);



        // Product::create([
        //     'brand_id' => 1,
        //     'size' => [
        //                 '1 KG 2,6',
        //                 '1 KG 2,6 NEW',
        //                 '1 KG 2,8',
        //                 '1 KG 2,8 NEW',
        //                 '1,25 KG',
        //                 '1,25 KG NEW',
        //                 '3 KG',
        //                 '3 KG NEW',
        //                 '18,75 KG',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '10',
        //                         '0',
        //                         '10',
        //                         '0',
        //                         '10',
        //                         '0',
        //                         '10',
        //                         '0',
        //                         '10',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 2,
        //     'size' => [
        //                 '20 KG 2,6 NEW',
        //                 'CURAH 2,6 NEW',
        //                 '20 KG 2,5 NEW',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '20',
        //                         '0',
        //                         '20',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 3,
        //     'size' => [
        //                 '6x2 (12KG)',
        //                 '9 KG',
        //                 '1 KG CURAH 2,6',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '6',
        //                         '24',
        //                         '0',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 4,
        //     'size' => [
        //                 'CURAH',
        //                 '10 KG',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '0',
        //                         '10',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 5,
        //     'size' => [
        //                 '10 KG',
        //                 '10 KG CURAH',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '10',
        //                         '0',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 6,
        //     'size' => [
        //                 '20 KG 26,5 NEW',
        //                 '10 KG',
        //                 '10 KG CURAH',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '20',
        //                         '10',
        //                         '10',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 7,
        //     'size' => [
        //                 '1 KG',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => '10',
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);

        // Product::create([
        //     'brand_id' => 8,
        //     'size' => [
        //                 '20 KG 2,6',
        //                 '1KG & 1/2 KG 2,5 ',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '20',
        //                         '20',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);


        // Product::create([
        //     'brand_id' => 10,
        //     'size' => [
        //                 '2,2',
        //                 '2,5 ',
        //     ],
        //     'stock_semifinish' => '0',
        //     'stock_finish' => '0',
        //     'need_inner' => [
        //                         '10',
        //                         '10',
        //     ],
        //     'user_id' => 1,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
    }
}
