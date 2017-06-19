<?php

namespace GaziWorks\Performance\Data\Repositories;

use DB;
use Exception;
use GaziWorks\Performance\Data\Models\Recipe;

class RecipeRepository
{

    public function all()
    {
        return Recipe::all();
    }

    public function getRecipesWithIngredients()
    {
        return Recipe::with('ingredients')->get();
    }

    public function lists()
    {
        return Recipe::pluck('name', 'id');
    }

    public function find($id)
    {
        return Recipe::with('ingredients')->find($id);
    }

    public function getIngredientsWithQuantityByRecipeId($id) {
        $id = (int)$id;
        return DB::table('ingredients')
                 ->leftJoin('recipe_ingredients', function($join) use ($id) {
                     $join->on('recipe_ingredients.ingredient_id', '=', 'ingredients.id');
                     $join->on('recipe_ingredients.recipe_id', '=', DB::raw($id));
                 })
                 ->select('ingredients.id', 'ingredients.name')
                 ->addSelect(DB::raw("recipe_ingredients.recipe_id = $id as selected"))
                 ->addSelect(DB::raw("IF(recipe_ingredients.recipe_id = $id, recipe_ingredients.quantity, 0) as quantity"))
                 ->get();
    }

    public function store($data)
    {
        $recipe              = new Recipe;
        $recipe->name        = $data['name'];
        $recipe->description = $data['description'];

        $recipeIngredients = [];
        foreach ($data['ingredients'] as $i) {
            if ($data['quantities'][$i] > 0) {
                $recipeIngredients[$i] = ['quantity' => $data['quantities'][$i]];
            }
        }

        try {
            DB::beginTransaction();

            $recipe->save();
            $recipe->ingredients()->sync($recipeIngredients);

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }

        return $recipe;
    }

    public function update($id, $data)
    {
        $recipe              = Recipe::find($id);
        $recipe->name        = $data['name'];
        $recipe->description = $data['description'];
        $recipe->save();

        $recipeIngredients = [];
        foreach ($data['ingredients'] as $i) {
            if ($data['quantities'][$i] > 0) {
                $recipeIngredients[$i] = ['quantity' => $data['quantities'][$i]];
            }
        }

        $recipe->ingredients()->sync($recipeIngredients);

        return $recipe;
    }

    public function delete($id)
    {
        Recipe::destroy($id);
    }

}