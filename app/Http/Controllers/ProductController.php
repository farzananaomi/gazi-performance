<?php

namespace GaziWorks\Performance\Http\Controllers;

use Exception;
use GaziWorks\Performance\Data\Models\Product;
use GaziWorks\Performance\Data\Repositories\ProductRepository;
use GaziWorks\Performance\Data\Repositories\RecipeRepository;
use GaziWorks\Performance\Http\Requests\CreateProductRequest;
use GaziWorks\Performance\Http\Requests\EditProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var \GaziWorks\Performance\Data\Repositories\ProductRepository
     */
    private $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
        $this->repo->setEnablePagination(false);
    }

    public function index(Request $request)
    {
        $name     = $request->get('name', null);
        $group_id = $request->get('group', null);

        $products = $this->repo->getProducts($name, $group_id);
        $groups   = $this->repo->groupLists();
        $subgroups   = $this->repo->subgroupLists();
        return view('products.index', compact('products', 'groups', 'subgroups', 'name', 'group_id'));
    }

    public function create(RecipeRepository $repo)
    {
        $subgroups = $this->repo->subgroupLists();
        $groups = $this->repo->groupLists();
        $recipes = $repo->lists();
        $autocompletes = $this->repo->autoCompleteData();

        return view('products.create', compact('groups', 'subgroups', 'recipes', 'autocompletes'));
    }

    public function store(CreateProductRequest $request)
    {
        $image           = $request->file('image');
        $destinationPath = storage_path('images/products');
        $fileName        = str_random(14) . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $fileName);
        $imagePath = 'products/' . $fileName;

        $this->repo->storeProduct($request, $imagePath);

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = $this->repo->findProduct($id);

        return view('products.show', compact('product'));
    }

    public function edit($id, RecipeRepository $repo)
    {
        $recipes = $repo->lists();
        $subgroups = $this->repo->subgroupLists();
        $groups = $this->repo->groupLists();
        $product = $this->repo->findProduct($id);
        $autocompletes = $this->repo->autoCompleteData();

        return view('products.edit', compact('product', 'groups', 'subgroups', 'recipes', 'autocompletes'));
    }

    public function update(EditProductRequest $request, $id)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $destinationPath = storage_path('images/products');
            $fileName        = str_random(14) . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);
            $imagePath = 'products/' . $fileName;
        }

        list(, $imagePath) = $this->repo->updateProduct($id, $request, $imagePath);
        if (!is_null($imagePath)) {
            try {
                unlink(storage_path("images/$imagePath"));
            } catch (Exception $ex) {

            }
        }

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $this->repo->deleteProduct($id);

        return redirect()->route('products.index');
    }
}
