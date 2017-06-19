<?php

namespace GaziWorks\Performance\Http\Controllers;

use GaziWorks\Performance\Data\Models\OverheadCostHeader;
use GaziWorks\Performance\Data\Models\OverheadGroup;
use GaziWorks\Performance\Data\Repositories\OverheadRepository;
use GaziWorks\Performance\Http\Requests\CreateOverheadCostRequest;
use GaziWorks\Performance\Http\Requests\StoreOverheadCostRequest;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

use GaziWorks\Performance\Http\Requests;

class OverheadCostController extends Controller
{
    private $repo;

    public function __construct(OverheadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $charts = $this->repo->getOverheadCostCharts();
        return view('overheads_costs.index', compact('charts'));
    }

    public function show($id)
    {
        $header = $this->repo->getOverheadCostChartById($id);
        return view('overheads_costs.show', compact('header'));

    }

    public function create(CreateOverheadCostRequest $request)
    {
        $overheads = $this->repo->getGroups();
        return view('overheads_costs.create', compact('overheads'));
    }

    public function store(StoreOverheadCostRequest $request)
    {
        $month = $request->get('month', null);
        $year = $request->get('year', null);
        $state = $request->get('state', 'final');
        $costs = $request->get('cost', []);

        $this->repo->storeOverheadCostChart($month, $year, $state, $costs);

        return redirect()->route('overheads.costs.index');
    }

}
