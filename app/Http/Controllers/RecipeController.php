<?php

namespace GaziWorks\Performance\Http\Controllers;

use GaziWorks\Performance\Data\Repositories\IngredientRepository;
use GaziWorks\Performance\Data\Repositories\RecipeRepository;
use GaziWorks\Performance\Http\Requests\CreateRecipeRequest;
use Illuminate\Http\Request;

use GaziWorks\Performance\Http\Requests;

class RecipeController extends Controller
{
    private $repo;

    public function __construct(RecipeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $recipes = $this->repo->all();

        return view('recipes.index', compact('recipes'));
    }

    public function create(IngredientRepository $repo)
    {
        $ingredients = $repo->all();
        return view('recipes.create', compact('ingredients'));
    }

    public function store(CreateRecipeRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('recipes.index');
    }

    public function show($id)
    {
        $recipe = $this->repo->find($id);

        return view('recipes.show', compact('recipe'));
    }

    public function edit($id)
    {
        $ingredients = $this->repo->getIngredientsWithQuantityByRecipeId($id);
        $recipe = $this->repo->find($id);

        return view('recipes.edit', compact('recipe', 'ingredients'));
    }

    public function update(CreateRecipeRequest $request, $id)
    {
        $this->repo->update($id, $request);

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);

        return redirect()->route('recipes.index');
    }
}
