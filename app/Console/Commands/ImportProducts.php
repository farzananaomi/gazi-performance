<?php

namespace GaziWorks\Performance\Console\Commands;

use GaziWorks\Performance\Data\Models\Product;
use GaziWorks\Performance\Data\Models\ProductPrice;
use GaziWorks\Performance\Data\Models\ProductPriceHeader;
use GaziWorks\Performance\Data\Models\ProductSale;
use GaziWorks\Performance\Data\Models\ProductSubGroup;
use GaziWorks\Performance\Data\Models\Recipe;
use GaziWorks\Performance\Data\Models\SalesHeader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use PHPExcel_IOFactory;
use PHPExcel_Reader_IReadFilter;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--i|interactive} {--f|filename=} {--s|start=} {--e|end=} {--m|month=} {--y|year=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Products from excel file';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename        = null;
        $start           = null;
        $end             = null;
        $month           = null;
        $year            = null;
        $interactiveMode = $this->option('interactive');
        if ($interactiveMode) {
            $filename = $this->ask('Enter file path ');
            $start    = $this->ask('Enter Start row ');
            $end      = $this->ask('Enter End row ');
            $month    = $this->ask('Enter Month ');
            $year     = $this->ask('Enter Year ');

        } else {
            $filename = $this->option('filename');
            $start    = $this->option('start');
            $end      = $this->option('end');
            $month    = $this->option('month');
            $year     = $this->option('year');
        }

        $excelReader = PHPExcel_IOFactory::createReaderForFile($filename);
        $excelReader->setReadDataOnly();
        //load only certain sheets from the file
        $loadSheets = ['perf_products'];
        $excelReader->setLoadSheetsOnly($loadSheets);
        $sampleFilter = new ReadProductsExcel($start, $end);
        $excelReader->setReadFilter($sampleFilter);
        $excelObj = $excelReader->load($filename);

        $rows        = $excelObj->getActiveSheet()->toArray(null, true, true, true);
        $progressbar = $this->output->createProgressBar($end - $start);

        $recipes  = Recipe::get()->pluck('id', 'name')->toArray();
        $subHeads = ProductSubGroup::get()->pluck('id', 'name')->toArray();

        try {
            DB::beginTransaction();

            $priceHeader        = new ProductPriceHeader();
            $priceHeader->month = $month;
            $priceHeader->year  = $year;
            $priceHeader->state = 'approved';
            $priceHeader->save();

            $salesHeader        = new SalesHeader();
            $salesHeader->month = $month;
            $salesHeader->year  = $year;
            $salesHeader->save();

            for ($i = $start; $i <= $end; ++$i) {
                $row = $rows[$i];

                $recipe = null;
                if (key_exists(trim($row['N']), $recipes)) {
                    $recipe = $recipes[trim($row['N'])];
                } else {
                    $recipe       = new Recipe();
                    $recipe->name = trim($row['N']);
                    $recipe->save();
                    $recipes[$recipe->name] = $recipe->id;
                    $recipe                 = $recipe->id;
                }

                $subHead = null;
                if (key_exists(trim($row['M']), $subHeads)) {
                    $subHead = $subHeads[trim($row['M'])];
                } else {
                    $subHead       = new ProductSubGroup();
                    $subHead->name = trim($row['M']);
                    $subHead->save();
                    $subHeads[$subHead->name] = $subHead->id;
                    $subHead                  = $subHead->id;
                }

                $product                       = new Product();
                $product->name                 = $row['C'];
                $product->code                 = $row['B'] . '';
                $product->description          = $row['D'] . '';
                $product->standard             = $row['E'] . '';
                $product->length               = $row['F'] * 1;
                $product->min_thickness        = $row['G'] * 1;
                $product->max_thickness        = $row['H'] * 1;
                $product->weight               = $row['I'] * 1;
                $product->color                = $row['K'] . '';
                $product->product_sub_group_id = $subHead;
                $product->recipe_id            = $recipe;
                $product->product_group_id     = $row['P'];
                $product->save();

                $price             = new ProductPrice();
                $price->header_id  = $priceHeader->id;
                $price->product_id = $product->id;
                $price->price      = $row['L'] . '';
                $price->save();

                $price                     = new ProductSale();
                $price->header_id          = $salesHeader->id;
                $price->product_id         = $product->id;
                $price->retail_quantity    = $row['O'] . '';
                $price->corporate_quantity = 0;
                $price->save();

                $progressbar->advance();
            }

            DB::commit();
        } catch (Exception $ex) {
            $this->error($ex->getMessage());

            DB::rollback();
        }
    }
}

class ReadProductsExcel implements PHPExcel_Reader_IReadFilter
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end   = $end;
    }

    public function readCell($column, $row, $worksheetName = '')
    {
        // Read rows 1 to 10 and columns A to C only
        if ($row >= $this->start && $row <= $this->end) {
            if (in_array($column, range('A', 'P'))) {
                return true;
            }
        }

        return false;
    }
}
