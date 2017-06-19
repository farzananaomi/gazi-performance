<?php

use GaziWorks\Performance\Data\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = [
            ['id' => '1','name' => 'Resin','description' => null],
            ['id' => '2','name' => 'CaCo3 (Coated)','description' => null],
            ['id' => '3','name' => 'CaCo3 (Non-coated)','description' => null],
            ['id' => '4','name' => 'Stabilizer','description' => null],
            ['id' => '5','name' => 'Stearic Acid','description' => null],
            ['id' => '6','name' => 'Wax','description' => null],
            ['id' => '7','name' => 'DOP','description' => null],
            ['id' => '8','name' => 'Optima','description' => null],
            ['id' => '9','name' => 'Pulverized Powder','description' => null],
            ['id' => '10','name' => 'Impact Modifier','description' => null],
            ['id' => '11','name' => 'TiO2','description' => null],
            ['id' => '12','name' => 'Hostalux','description' => null],
            ['id' => '13','name' => 'Pigment Grey','description' => null],
            ['id' => '14','name' => 'Pigment Blue','description' => null],
            ['id' => '15','name' => 'Pigment Green','description' => null],
            ['id' => '16','name' => 'Pigment Yellow','description' => null]
        ];

        foreach ($ingredients as $row) {
            $ingredient = new Ingredient();
            $ingredient->id = $row['id'];
            $ingredient->name = $row['name'];
            $ingredient->save();
        }
    }
}
