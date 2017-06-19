<?php

use GaziWorks\Performance\Data\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_groups = [
            ['id' => '1','name' => 'uPVC Pipes'],
            ['id' => '2','name' => 'uPVC Filter'],
            ['id' => '3','name' => 'HDPE Coil Pipes'],
            ['id' => '4','name' => 'Suction Hose Pipes']
        ];

        foreach ($product_groups as $row) {
            $group = new ProductGroup();
            $group->id = $row['id'];
            $group->name = $row['name'];
            $group->save();
        }
    }
}
