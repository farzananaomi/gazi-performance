<?php

namespace GaziWorks\Performance\Data\Repositories;

use GaziWorks\Performance\Data\Models\Ingredient;

class IngredientRepository
{

    public function all()
    {
        return Ingredient::all();
    }

    public function lists()
    {
        return Ingredient::pluck('name', 'id');
    }

    public function find($id)
    {
        return Ingredient::find($id);
    }

    public function store($data)
    {
        $ingredient = new Ingredient;
        $ingredient->name = $data['name'];
        $ingredient->description = $data['description'];
        $ingredient->price = $data['price'];
        $ingredient->save();

        return $ingredient;
    }

    public function update($id, $data)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->name = $data['name'];
        $ingredient->description = $data['description'];
        $ingredient->price = $data['price'];
        $ingredient->save();

        return $ingredient;
    }

    public function delete($id)
    {
        Ingredient::destroy($id);
    }

}
