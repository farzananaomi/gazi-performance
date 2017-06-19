<?php

namespace GaziWorks\Performance\Data\Repositories;


use GaziWorks\Performance\Data\Models\Product;
use GaziWorks\Performance\Data\Models\ProductGroup;
use GaziWorks\Performance\Data\Models\ProductSubGroup;

class ProductRepository
{
    use PaginatedResultTrait;

    public function autoCompleteData()
    {
        $products  = Product::distinct()->select(['standard'])->where('standard', '<>', '')->lists('standard');
        $standards = [];
        foreach ($products as $v) {
            $standards[] = (object)['value' => $v];
        }

        $products = Product::distinct()->select(['color'])->where('color', '<>', '')->lists('color');
        $colors   = [];
        foreach ($products as $v) {
            $colors[] = (object)['value' => $v];
        }

        return ['standards' => $standards, 'colors' => $colors];
    }

    public function groupLists()
    {
        return ProductGroup::pluck('name', 'id');
    }

    public function getGroups()
    {
        if ($this->isEnablePagination()) {

            $groups = ProductGroup::paginate($this->getResultsPerPage());

            return $groups;
        } else {

            return ProductGroup::all();
        }
    }

    public function findGroup($id)
    {
        return ProductGroup::find($id);
    }

    public function storeGroup($data)
    {
        $group              = new ProductGroup;
        $group->name        = $data['name'];
        $group->description = $data['description'];

        $group->save();

        return $group;
    }

    public function updateGroup($id, $data)
    {
        $group              = ProductGroup::find($id);
        $group->name        = $data['name'];
        $group->description = $data['description'];

        $group->save();

        return $group;
    }

    public function productGroupedLists()
    {
        return ProductGroup::with([
            'products' => function ($query) {
                $query->select('id', 'name', 'color', 'product_group_id');
            },
        ])->select('id', 'name')->get();
    }

    public function subgroupLists()
    {
        return ProductSubGroup::pluck('name', 'id');
    }

    public function getSubgroups()
    {
        if ($this->isEnablePagination()) {

            $groups = ProductSubGroup::paginate($this->getResultsPerPage());

            return $groups;
        } else {

            return ProductSubGroup::all();
        }
    }

    public function productLists()
    {
        return Product::pluck('name', 'id');
    }

    public function getProducts($name = null, $group = null)
    {
        $products = Product::with('group');

        if ($name != null) {
            $products = $products->where('name', 'LIKE', "%$name%");
        }

        if ($group != null) {
            $products = $products->where('product_group_id', 'LIKE', "%$group%");
        }

        if ($this->isEnablePagination()) {

            $products = $products->orderBy('product_group_id')->paginate($this->getResultsPerPage());

            return $products;
        } else {

            return $products->get();
        }
    }

    public function findProduct($id)
    {
        return Product::with([
            'recipe' => function ($query) {
                $query->with('ingredients');
            },
            'group',
        ])->find($id);
    }

    public function storeProduct($data, $imagePath)
    {
        $product                       = new Product;
        $product->code                 = $data['code'];
        $product->name                 = $data['name'];
        $product->description          = $data['description'];
        $product->standard             = $data['standard'];
        $product->length               = $data['length'];
        $product->min_thickness        = $data['min_thickness'];
        $product->max_thickness        = $data['max_thickness'];
        $product->weight               = $data['weight'];
        $product->color                = $data['color'];
        $product->image_path           = $imagePath;
        $product->recipe_id            = $data['recipe_id'];
        $product->product_group_id     = $data['product_group_id'];
        $product->product_sub_group_id = $data['product_sub_group_id'];
        $product->save();

        return $product;
    }

    public function updateProduct($id, $data, $imagePath)
    {
        $product                       = Product::find($id);
        $product->code                 = $data['code'];
        $product->name                 = $data['name'];
        $product->description          = $data['description'];
        $product->standard             = $data['standard'];
        $product->length               = $data['length'];
        $product->min_thickness        = $data['min_thickness'];
        $product->max_thickness        = $data['max_thickness'];
        $product->weight               = $data['weight'];
        $product->color                = $data['color'];
        $product->recipe_id            = $data['recipe_id'];
        $product->product_group_id     = $data['product_group_id'];
        $product->product_sub_group_id = $data['product_sub_group_id'];

        $unlink = null;
        if (!is_null($imagePath)) {
            $unlink              = $product->image_path;
            $product->image_path = $imagePath;
        }
        $product->save();

        return [$product, $unlink];
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
    }
}