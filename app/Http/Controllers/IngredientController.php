<?php

namespace GaziWorks\Performance\Http\Controllers;

use GaziWorks\Performance\Data\Repositories\IngredientRepository;
use GaziWorks\Performance\Http\Requests\CreateIngredientRequest;

class IngredientController extends Controller
{
    private $repo;

    public function __construct(IngredientRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $ingredients = $this->repo->all();

        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(CreateIngredientRequest $request)
    {
        $this->repo->store($request);

        return redirect()->route('ingredients.index');
    }

    public function show($id)
    {
        $ingredient = $this->repo->find($id);

        return view('ingredients.show', compact('ingredient'));
    }

    public function edit($id)
    {
        $ingredient = $this->repo->find($id);

        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(CreateIngredientRequest $request, $id)
    {
        $this->repo->update($id, $request);

        return redirect()->route('ingredients.index');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);

        return redirect()->route('ingredients.index');
    }
}
