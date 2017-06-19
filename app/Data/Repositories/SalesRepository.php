<?php
namespace GaziWorks\Performance\Data\Repositories;


use GaziWorks\Performance\Data\Models\SalesHeader;

class SalesRepository
{
    public function getHeaders()
    {
        return SalesHeader::all();
    }

    public function getSalesChart($id)
    {
        $chart = SalesHeader::with(['salesData' => function($query) {
                        return $query->join('products', 'products.id', '=', 'product_sales.product_id');
                    }])->find($id);

        return $chart;
    }

    public function getSalesChartByMonthYear($month, $year)
    {
        $chart = SalesHeader::where('month', '=', $month)
                            ->where('year', '=', $year)
                            ->with(['salesData' => function($query) {
                                return $query->join('products', 'products.id', '=', 'product_sales.product_id');
                            }])
                            ->first();

        return $chart;
    }
}