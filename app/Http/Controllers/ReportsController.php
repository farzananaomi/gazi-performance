<?php

namespace GaziWorks\Performance\Http\Controllers;

use Carbon\Carbon;
use GaziWorks\Performance\Data\Repositories\IngredientRepository;
use GaziWorks\Performance\Data\Repositories\ReportsRepository;
use GaziWorks\Performance\Http\Requests\ShowReportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use PHPExcel_Style_NumberFormat;

class ReportsController extends Controller
{
    protected $request;
    protected $reports;

    protected $year;
    protected $month;
    protected $type;

    protected $dataAvailable = true;

    protected $total_weight;
    protected $retail_weight;
    protected $corporate_weight;
    protected $total_cash;
    protected $retail_cash;
    protected $corporate_cash;
    protected $total_quantity;
    protected $retail_quantity;
    protected $corporate_quantity;
    protected $total_overhead;
    protected $variable_overhead;
    protected $fixed_overhead;

    public function __construct(ReportsRepository $reports, Request $request)
    {
        $this->reports = $reports;
        $this->request = $request;

        if ($request->is('reports/*')) {
            $this->month = Carbon::parse($this->request->get('month',
                $this->request->get('report-date', 'today')))->format('F');
            $this->year  = Carbon::parse($this->request->get('year',
                $this->request->get('report-date', 'today')))->format('Y');

            $this->type = $request->get('report-type', 'retail') == 'retail' ? 'retail' : 'corporate';
            $this->reports->setReportType($this->type);

            $overviewStats = $this->reports->getOverallSalesStats($this->month, $this->year);

            $this->dataAvailable      = $overviewStats->data_exists;
            $this->total_weight       = $overviewStats->total_weight;
            $this->retail_weight      = $overviewStats->retail_weight;
            $this->corporate_weight   = $overviewStats->corporate_weight;
            $this->total_cash         = $overviewStats->total_cash;
            $this->retail_cash        = $overviewStats->retail_cash;
            $this->corporate_cash     = $overviewStats->corporate_cash;
            $this->total_quantity     = $overviewStats->total_quantity;
            $this->retail_quantity    = $overviewStats->retail_quantity;
            $this->corporate_quantity = $overviewStats->corporate_quantity;
            $this->total_overhead     = $overviewStats->total_overhead;
            $this->variable_overhead  = $overviewStats->variable_overhead;
            $this->fixed_overhead     = $overviewStats->fixed_overhead;


            view()->share('overallSalesWeight', $this->total_weight);
            view()->share('totalOverheadCost', $this->total_overhead);
            view()->share('variableOverheadCost', $this->variable_overhead);
            view()->share('fixedOverheadCost', $this->fixed_overhead);
            view()->share('queryMonth', $this->month);
            view()->share('queryYear', $this->year);
            view()->share('reportType', $this->type);
            view()->share('salesHeader', $overviewStats->sales);

            if ($this->type == 'corporate') {
                view()->share('totalSalesCash', $this->corporate_cash);
                view()->share('totalSalesQuantity', $this->corporate_quantity);
                view()->share('totalSalesWeight', $this->corporate_weight);
            } else {
                view()->share('totalSalesCash', $this->retail_cash);
                view()->share('totalSalesQuantity', $this->retail_quantity);
                view()->share('totalSalesWeight', $this->retail_weight);
            }
        }
    }

    public function index()
    {
        $reports = $this->reports->getReports();

        return view('reports.index', compact('reports'));
    }

    public function getOverview(ShowReportRequest $request)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }

        list($groups, $subgroups, $topCashProducts, $topQuantityProducts, $ingredients)
            = $this->reports->getOverviewStatistics($this->month, $this->year);

        return view('reports.overview',
            compact('groups', 'subgroups', 'topCashProducts', 'topQuantityProducts', 'ingredients'));
    }

    public function getGroupList(ShowReportRequest $request)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        list($groups, $subgroups, $topCashProducts, $topQuantityProducts)
            = $this->reports->getOverviewStatistics($this->month, $this->year);

        return view('reports.groups.index', compact('groups'));
    }

    public function getGroup($id, ShowReportRequest $request, IngredientRepository $ingredients)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        list($group, $products) = $this->reports->getGroupStatistics($this->month, $this->year, $id);
        $products->load([
            'recipe' => function ($query) {
                return $query->with('ingredients');
            },
        ]);
        $ingredients = $ingredients->all()->keyBy('id');

        foreach ($products as $product) {
            foreach ($product->recipe->ingredients as $item) {
                $ingredient             = $ingredients[$item->id];
                $ingredient->usedQuantity = @$ingredient->usedQuantity + $item->pivot->quantity;
            }
        }

        return view('reports.groups.show', compact('group', 'products', 'ingredients'));
    }

    public function getSubgroupList(ShowReportRequest $request)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        list($groups, $subgroups, $topCashProducts, $topQuantityProducts)
            = $this->reports->getOverviewStatistics($this->month, $this->year);

        return view('reports.subgroups.index', compact('subgroups', 'products'));
    }

    public function getSubgroup($id, ShowReportRequest $request, IngredientRepository $ingredients)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        list($subgroup, $products) = $this->reports->getSubgroupStatistics($this->month, $this->year, $id);

        $products->load([
            'recipe' => function ($query) {
                return $query->with('ingredients');
            },
        ]);
        $ingredients = $ingredients->all()->keyBy('id');

        foreach ($products as $product) {
            foreach ($product->recipe->ingredients as $item) {
                $ingredient             = $ingredients[$item->id];
                $ingredient->usedQuantity = @$ingredient->usedQuantity + $item->pivot->quantity;
            }
        }

        return view('reports.subgroups.show', compact('subgroup', 'products', 'ingredients'));
    }

    public function getProductsList(ShowReportRequest $request)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        $products = $this->reports->getProductsStatistics($this->month, $this->year);

        return view('reports.products.index', compact('products'));
    }

    public function getProduct($id, ShowReportRequest $request)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        $product = $this->reports->getProductStatistics($this->month, $this->year, $id);

        return view('reports.products.show', compact('product'));
    }

    public function exportProducts(ShowReportRequest $request, Excel $excel)
    {
        if (($dataAvailable = $this->checkDataExists()) !== false) {
            return $dataAvailable;
        }
        $products = $this->reports->getProductsStatistics($this->month, $this->year);

        $month              = $this->month;
        $year               = $this->year;
        $totalSalesCash     = null;
        $totalSalesQuantity = null;
        $totalSalesWeight   = null;

        if ($this->type == 'corporate') {
            $totalSalesCash = $this->corporate_cash;
            $totalSalesQuantity = $this->corporate_quantity;
            $totalSalesWeight = $this->corporate_weight;
        } else {
            $totalSalesCash = $this->retail_cash;
            $totalSalesQuantity = $this->retail_quantity;
            $totalSalesWeight = $this->retail_weight;
        }

        return $excel->create("Products Sales Report - {$this->month}, {$this->year}",
            function ($excel) use ($products, $totalSalesCash, $totalSalesQuantity, $totalSalesWeight, $month, $year) {
                $excel->sheet('Products', function ($sheet) use (
                    $products,
                    $totalSalesCash,
                    $totalSalesQuantity,
                    $totalSalesWeight,
                    $month,
                    $year
                ) {
                    $sheet->freezePane('A5');
                    $sheet->setColumnFormat([
                        'G' => '"Tk. "#,##0.00_-',
                        'I' => '#,##0.00_-',
                        'J' => '"Tk. "#,##0.00_-',
                        'K' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00,
                        'L' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00,
                    ]);
                    $sheet->loadView('reports.excel.products',
                        compact('products', 'totalSalesCash', 'totalSalesQuantity', 'totalSalesWeight', 'month',
                            'year'));
                });
            })->download('xls');
    }

    public function checkDataExists()
    {
        if (!$this->dataAvailable) {
            return redirect()->route('reports')
                             ->with('data_available', false);
        }

        return false;
    }
}
