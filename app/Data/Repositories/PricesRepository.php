<?php

namespace GaziWorks\Performance\Data\Repositories;

use DB;
use GaziWorks\Performance\Data\Models\Product;
use GaziWorks\Performance\Data\Models\ProductPrice;
use GaziWorks\Performance\Data\Models\ProductPriceHeader;

class PricesRepository
{
    public function getProductPriceCharts()
    {
        return ProductPriceHeader::paginate(30);
    }

    public function getProductPriceChart($month, $year)
    {
        $header = ProductPriceHeader::where('month', '=', $month)
                                   ->where('year', '=', $year)
                                   ->first();
        $productPrices = null;
        if ($header !== null) {
            $productPrices = Product::leftJoin('product_prices', 'product_prices.product_id', '=', 'products.id')
                           ->select('products.*', 'product_prices.price')
                           ->where('product_prices.header_id', '=', $header->id)
                           ->with('group', 'subgroup')
                           ->get();

        }

        return [$header, $productPrices, $header !== null];
    }

    public function storeProductPrices($month, $year, $prices)
    {
        try {
            DB::beginTransaction();
            $header        = new ProductPriceHeader();
            $header->month = $month;
            $header->year  = $year;
            $header->state = 'final';
            $header->save();

            foreach ($prices as $productId => $price) {
                $p = new ProductPrice();
                $p->header_id  = $header->id;
                $p->product_id = $productId;
                $p->price      = $price;
                $p->save();
            }

            DB::commit();
        } catch (\Exception $ex) {

            DB::rollback();
        }
    }
}