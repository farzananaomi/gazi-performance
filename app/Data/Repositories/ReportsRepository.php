<?php

namespace GaziWorks\Performance\Data\Repositories;

use DB;
use GaziWorks\Performance\Data\Models\Ingredient;
use GaziWorks\Performance\Data\Models\OverheadCost;
use GaziWorks\Performance\Data\Models\OverheadCostHeader;
use GaziWorks\Performance\Data\Models\Product;
use GaziWorks\Performance\Data\Models\ProductGroup;
use GaziWorks\Performance\Data\Models\ProductPriceHeader;
use GaziWorks\Performance\Data\Models\ProductSubGroup;
use GaziWorks\Performance\Data\Models\SalesHeader;

class ReportsRepository
{
    protected $type = 'retail';

    public function setReportType($type)
    {
        $this->type = $type;
    }

    private function getQuantityColumnName()
    {
        if ($this->type == 'corporate') {
            return '`product_sales`.`corporate_quantity`';
        } else {
            return '`product_sales`.`retail_quantity`';
        }
    }

    public function getReports()
    {
        return SalesHeader::all();
    }

    public function getOverallSalesStats($month, $year)
    {
        $salesHeader = SalesHeader::where('month', '=', $month)
                                  ->where('year', '=', $year)
                                  ->first();
        $priceHeader = ProductPriceHeader::where('month', '=', $month)
                                         ->where('year', '=', $year)
                                         ->where('state', '=', 'final')
                                         ->first();


        $overheadHeader = OverheadCostHeader::where('month', '=', $month)
                                            ->where('year', '=', $year)
                                            ->where('state', '=', 'final')
                                            ->first();
        $exists         = ($salesHeader != null) && ($priceHeader != null) && ($overheadHeader != null);
        $sales          = null;
        $overheads      = null;
        if ($exists) {
            $sales = Product::join('product_prices', 'product_prices.product_id', '=', 'products.id')
                            ->join('product_sales', 'product_prices.product_id', '=', 'product_sales.product_id')
                            ->where('product_prices.header_id', '=', $priceHeader->id)
                            ->where('product_sales.header_id', '=', $salesHeader->id)
                            ->select(DB::raw("sum(products.weight*product_sales.retail_quantity) as retail_weight"),
                                DB::raw("sum(products.weight*product_sales.corporate_quantity) as corporate_weight"),
                                DB::raw("sum( product_prices.price*product_sales.retail_quantity) as retail_cash"),
                                DB::raw("sum( product_prices.price*product_sales.corporate_quantity) as corporate_cash"),
                                DB::raw("sum(product_sales.retail_quantity) as retail_quantity"),
                                DB::raw("sum(product_sales.corporate_quantity) as corporate_quantity"))
                            ->first();

            $overheads = OverheadCost::join('overhead_titles', 'overhead_titles.id', '=', 'overhead_costs.overhead_id')
                                     ->select('overhead_costs.*', 'overhead_titles.type')
                                     ->where('header_id', '=', $overheadHeader->id)
                                     ->get();
        }
        $totalOverheadCost = $overheads !== null ? $overheads->sum(function ($item) {
            return $item->cost;
        }) : 0;

        $variableOverheadCost = $overheads !== null ? $overheads->sum(function ($item) {
            if ($item->type == 'variable') {
                return $item->cost;
            }

            return 0;
        }) : 0;

        $fixedOverheadCost = $overheads !== null ? $overheads->sum(function ($item) {
            if ($item->type == 'fixed') {
                return $item->cost;
            }

            return 0;
        }) : 0;

        return (object)[
            'data_exists'        => $exists,
            'total_weight'       => ($sales != null ? $sales->retail_weight : 0) + ($sales != null ? $sales->corporate_weight : 0),
            'retail_weight'      => ($sales != null ? $sales->retail_weight : 0),
            'corporate_weight'   => ($sales != null ? $sales->corporate_weight : 0),
            'total_cash'         => ($sales != null ? $sales->retail_cash : 0) + ($sales != null ? $sales->corporate_cash : 0),
            'retail_cash'        => ($sales != null ? $sales->retail_cash : 0),
            'corporate_cash'     => ($sales != null ? $sales->corporate_cash : 0),
            'total_quantity'     => ($sales != null ? $sales->retail_quantity : 0) + ($sales != null ? $sales->corporate_quantity : 0),
            'retail_quantity'    => ($sales != null ? $sales->retail_quantity : 0),
            'corporate_quantity' => ($sales != null ? $sales->corporate_quantity : 0),
            'total_overhead'     => $totalOverheadCost,
            'variable_overhead'  => $variableOverheadCost,
            'fixed_overhead'     => $fixedOverheadCost,
            'sales'              => $salesHeader,
        ];
    }

    public function getOverviewStatistics($month, $year)
    {
        $groups    = ProductGroup::all()->keyBy('id');
        $subgroups = ProductSubGroup::all()->keyBy('id');

        $salesHeader = SalesHeader::where('month', '=', $month)
                                  ->where('year', '=', $year)
                                  ->first();
        $priceHeader = ProductPriceHeader::where('month', '=', $month)
                                         ->where('year', '=', $year)
                                         ->where('state', '=', 'final')
                                         ->first();

        $products = Product::join('product_prices', 'product_prices.product_id', '=', 'products.id')
                           ->join('product_sales', 'product_prices.product_id', '=', 'product_sales.product_id')
                           ->where('product_prices.header_id', '=', $priceHeader->id)
                           ->where('product_sales.header_id', '=', $salesHeader->id)
                           ->select('products.name', 'products.code', 'products.recipe_id', 'products.color',
                               DB::raw("products.id as product_id"),
                               'products.product_group_id', 'products.product_sub_group_id',
                               'product_prices.price',
                               DB::raw("product_prices.price*{$this->getQuantityColumnName()} as cash"),
                               DB::raw("{$this->getQuantityColumnName()} as quantity"))
                           ->get();

        $products->load('recipe.ingredients');
        $products = collect($products);
        foreach ($products as $product) {
            $group           = $groups->get($product->product_group_id);
            $group->cash     = @$group->cash + $product->cash;
            $group->quantity = @$group->quantity + $product->quantity;

            $subgroup           = $subgroups->get($product->product_sub_group_id);
            $subgroup->cash     = @$subgroup->cash + $product->cash;
            $subgroup->quantity = @$subgroup->quantity + $product->quantity;
        }

        $ingredients = Ingredient::all()->keyBy('id');
        foreach ($products as $product) {
            $totalRecipeWeight = $product->recipe->ingredients->sum(function($item) {
                return $item->pivot->quantity();
            });
            foreach ($product->recipe->ingredients as $item) {
                $ingredient               = $ingredients[$item->id];
                $ingredient->usedQuantity = @$ingredient->usedQuantity + (
                                                    ($item->pivot->quantity/$totalRecipeWeight)
                                                    * $product->weight*$product->quantity
                                            );
            }

        }

        $topCashProducts     = $products->sortByDesc('cash')->take(10);
        $topQuantityProducts = $products->sortByDesc('quantity')->take(10);

        return [$groups, $subgroups, $topCashProducts, $topQuantityProducts, $ingredients];

    }

    public function getGroupStatistics($month, $year, $id)
    {
        $group       = ProductGroup::find($id);
        $salesHeader = SalesHeader::where('month', '=', $month)
                                  ->where('year', '=', $year)
                                  ->first();
        $priceHeader = ProductPriceHeader::where('month', '=', $month)
                                         ->where('year', '=', $year)
                                         ->where('state', '=', 'final')
                                         ->first();

        $products = Product::join('product_prices', 'product_prices.product_id', '=', 'products.id')
                           ->join('product_sales', 'product_prices.product_id', '=', 'product_sales.product_id')
                           ->where('product_prices.header_id', '=', $priceHeader->id)
                           ->where('product_sales.header_id', '=', $salesHeader->id)
                           ->where('products.product_group_id', '=', $group->id)
                           ->select('products.name', 'products.code', 'products.color',
                               DB::raw("products.id as product_id"),
                               'products.recipe_id', 'products.product_group_id', 'products.product_sub_group_id',
                               'product_prices.price',
                               DB::raw("product_prices.price*{$this->getQuantityColumnName()} as cash"),
                               DB::raw("{$this->getQuantityColumnName()} as quantity"))
                           ->get();

        foreach ($products as $product) {
            $group->cash     = @$group->cash + $product->cash;
            $group->quantity = @$group->quantity + $product->quantity;
        }

        return [$group, $products];
    }

    public function getSubgroupStatistics($month, $year, $id)
    {
        $subgroup    = ProductSubGroup::find($id);
        $salesHeader = SalesHeader::where('month', '=', $month)
                                  ->where('year', '=', $year)
                                  ->first();
        $priceHeader = ProductPriceHeader::where('month', '=', $month)
                                         ->where('year', '=', $year)
                                         ->where('state', '=', 'final')
                                         ->first();

        $products = Product::join('product_prices', 'product_prices.product_id', '=', 'products.id')
                           ->join('product_sales', 'product_prices.product_id', '=', 'product_sales.product_id')
                           ->where('product_prices.header_id', '=', $priceHeader->id)
                           ->where('product_sales.header_id', '=', $salesHeader->id)
                           ->where('products.product_sub_group_id', '=', $subgroup->id)
                           ->select('products.name', 'products.code', 'products.color',
                               DB::raw("products.id as product_id"),
                               'products.recipe_id', 'products.product_group_id', 'products.product_sub_group_id',
                               'product_prices.price',
                               DB::raw("product_prices.price*{$this->getQuantityColumnName()} as cash"),
                               DB::raw("{$this->getQuantityColumnName()} as quantity"))
                           ->get();

        foreach ($products as $product) {
            $subgroup->cash     = @$subgroup->cash + $product->cash;
            $subgroup->quantity = @$subgroup->quantity + $product->quantity;
        }

        return [$subgroup, $products];
    }

    public function getProductsStatistics($month, $year)
    {
        $salesHeader = SalesHeader::where('month', '=', $month)
                                  ->where('year', '=', $year)
                                  ->first();
        $priceHeader = ProductPriceHeader::where('month', '=', $month)
                                         ->where('year', '=', $year)
                                         ->where('state', '=', 'final')
                                         ->first();
        $products    = Product::join('product_prices', 'product_prices.product_id', '=', 'products.id')
                              ->join('product_sales', 'product_prices.product_id', '=', 'product_sales.product_id')
                              ->where('product_prices.header_id', '=', $priceHeader->id)
                              ->where('product_sales.header_id', '=', $salesHeader->id)
                              ->select('products.*', 'product_prices.price',
                                  DB::raw("product_prices.price*{$this->getQuantityColumnName()} as cash"),
                                  DB::raw("{$this->getQuantityColumnName()} as quantity"))
                              ->with('recipe')
                              ->get();

        $products->load('group', 'subgroup');

        return $products;
    }

    public function getProductStatistics($month, $year, $id)
    {
        $salesHeader = SalesHeader::where('month', '=', $month)
                                  ->where('year', '=', $year)
                                  ->first();
        $priceHeader = ProductPriceHeader::where('month', '=', $month)
                                         ->where('year', '=', $year)
                                         ->where('state', '=', 'final')
                                         ->first();
        $product     = Product::join('product_prices', 'product_prices.product_id', '=', 'products.id')
                              ->join('product_sales', 'product_prices.product_id', '=', 'product_sales.product_id')
                              ->where('product_prices.header_id', '=', $priceHeader->id)
                              ->where('product_sales.header_id', '=', $salesHeader->id)
                              ->where('products.id', '=', $id)
                              ->select('products.*', 'product_prices.price',
                                  DB::raw("product_prices.price*{$this->getQuantityColumnName()} as cash"),
                                  DB::raw("{$this->getQuantityColumnName()} as quantity"))
                              ->with('recipe')
                              ->first();

        return $product;
    }
}