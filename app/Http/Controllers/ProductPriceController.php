<?php

namespace GaziWorks\Performance\Http\Controllers;

use Carbon\Carbon;
use GaziWorks\Performance\Data\Repositories\PricesRepository;
use GaziWorks\Performance\Data\Repositories\ProductRepository;
use GaziWorks\Performance\Http\Requests\CreatePriceChartRequest;
use GaziWorks\Performance\Http\Requests\ShowPriceChartRequest;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    protected $repo;

    public function __construct(PricesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $charts = $this->repo->getProductPriceCharts();

        return view('product_prices.index', compact('charts'));
    }

    public function show(ShowPriceChartRequest $request,ProductRepository $products)
    {
        $month = Carbon::parse($request->get('month', $request->get('report-date', 'today')))->format('F');
        $year = Carbon::parse($request->get('year', $request->get('report-date', 'today')))->format('Y');

        list($header, $prices, $exists) = $this->repo->getProductPriceChart($month, $year);
        if (!$exists) {
            return redirect()->route('products.prices.index')
                ->with('data_available', $exists);
        }

        $groups = $products->groupLists();
        $subgroups = $products->subgroupLists();
        return view('product_prices.show', compact('header', 'prices', 'groups', 'subgroups'));
    }

    public function create(ShowPriceChartRequest $request,ProductRepository $products)
    {
        $month = Carbon::parse($request->get('month', $request->get('report-date', 'today')))->format('F');
        $year = Carbon::parse($request->get('year', $request->get('report-date', 'today')))->format('Y');

        list($header, $prices, $exists) = $this->repo->getProductPriceChart($month, $year);

        $products->setEnablePagination(false);
        $products = $products->getProducts();
        return view('product_prices.create', compact('products'));
    }

    public function store(CreatePriceChartRequest $request,ProductRepository $products)
    {
        $month  = Carbon::parse($request->get('month', $request->get('report-date', 'today')))->format('F');
        $year   = Carbon::parse($request->get('year', $request->get('report-date', 'today')))->format('Y');
        $prices = $request->get('prices');

        $this->repo->storeProductPrices($month, $year, $prices);
        return redirect()->route('products.prices.index');
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

}
