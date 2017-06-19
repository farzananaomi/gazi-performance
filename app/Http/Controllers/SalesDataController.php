<?php

namespace GaziWorks\Performance\Http\Controllers;

use Carbon\Carbon;
use GaziWorks\Performance\Data\Repositories\ProductRepository;
use GaziWorks\Performance\Data\Repositories\SalesRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

class SalesDataController extends Controller
{
    protected $repo;

    public function __construct(SalesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request, Container $container)
    {
        $month  = $request->get('month', $request->get('report-date', null));
        $year   = $request->get('year', $request->get('report-date', null));

        if ($month != null && $year != null)
        {
            return $container->call(
                [$this, 'show'],
                ['id' => null]
            );
        }

        $charts = $this->repo->getHeaders();
        return view('sales.index', compact('charts'));
    }

    public function show($id, Request $request, ProductRepository $products)
    {
        $month  = Carbon::parse($request->get('month', $request->get('report-date', 'today')))->format('F');
        $year   = Carbon::parse($request->get('year', $request->get('report-date', 'today')))->format('Y');

        $sale = null;
        if ($id == null) {
            $sale = $this->repo->getSalesChartByMonthYear($month, $year);
        } else {
            $sale = $this->repo->getSalesChart($id);
        }

        if ($sale == null) {
            return redirect()->route('sales.index')
                             ->with('data_available', $sale != null);
        }

        $groups = $products->groupLists();
        $subgroups = $products->subgroupLists();

        return view('sales.show', compact('sale', 'groups', 'subgroups'));
    }
}
