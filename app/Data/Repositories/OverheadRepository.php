<?php
namespace GaziWorks\Performance\Data\Repositories;

use DB;
use GaziWorks\Performance\Data\Models\OverheadCost;
use GaziWorks\Performance\Data\Models\OverheadCostHeader;
use GaziWorks\Performance\Data\Models\OverheadGroup;
use GaziWorks\Performance\Data\Models\OverheadTitle;
use Mockery\CountValidator\Exception;

class OverheadRepository
{
    public function getGroups()
    {
        return OverheadGroup::get();
    }

    public function listGroups()
    {
        return OverheadGroup::pluck('name', 'id');
    }

    public function getGroupedTitles()
    {
        return OverheadGroup::with('titles')->get();
    }

    public function getTitles()
    {
        return OverheadTitle::get();
    }

    public function listTitles()
    {
        return OverheadTitle::pluck('name', 'id');
    }

    public function findTitle($id)
    {
        return OverheadTitle::find($id);
    }

    public function storeTitle($data)
    {
        $overhead                    = new OverheadTitle;
        $overhead->name              = $data['name'];
        $overhead->description       = $data['description'];
        $overhead->overhead_group_id = $data['overhead_group_id'];
        $overhead->type              = $data['type'];
        $overhead->save();

        return $overhead;
    }

    public function updateTitle($id, $data)
    {
        $overhead                    = OverheadTitle::find($id);
        $overhead->name              = $data['name'];
        $overhead->description       = $data['description'];
        $overhead->overhead_group_id = $data['overhead_group_id'];
        $overhead->type              = $data['type'];
        $overhead->save();

        return $overhead;
    }

    public function deleteTitle($id)
    {
        OverheadTitle::destroy($id);
    }

    public function findGroup($id)
    {
        return OverheadGroup::find($id);
    }

    public function storeGroup($data)
    {
        $overhead                    = new OverheadGroup;
        $overhead->name              = $data['name'];
        $overhead->description       = $data['description'];
        $overhead->save();

        return $overhead;
    }

    public function updateGroup($id, $data)
    {
        $overhead                    = OverheadGroup::find($id);
        $overhead->name              = $data['name'];
        $overhead->description       = $data['description'];
        $overhead->save();

        return $overhead;
    }

    public function deleteGroup($id)
    {
        OverheadGroup::destroy($id);
    }

    public function getOverheadCostCharts()
    {
        return OverheadCostHeader::all();
    }

    public function getOverheadCostChartById($id)
    {
        $header = OverheadCostHeader::find($id);
        $header->load('costs.title.group');
        $groups = $header->costs->pluck('title.group')->keyBy('id');
        $titles = $header->costs->pluck('title')->keyBy('id');

        foreach ($header->costs as $cost)
        {
            $titles->get($cost->overhead_id)->cost = $cost->cost;
        }

        foreach ($titles as $key => $title)
        {
            $groups->get($title->overhead_group_id)->titles[] = $title;
        }

        foreach ($groups as $group)
        {
            $group->titles = collect($group->titles);
        }

        $header->groups = $groups;

        return $header;
    }

    public function storeOverheadCostChart($month, $year, $state, $costs)
    {
        try {
            DB::connection()->getPdo()->beginTransaction();
            $chart        = new OverheadCostHeader();
            $chart->year  = $year;
            $chart->month = $month;
            $chart->state = $state;
            $chart->save();
            $costList = [];
            foreach ($costs as $overheadId => $cost) {
                $costList[] = [
                    'overhead_id' => $overheadId,
                    'header_id'   => $chart->id,
                    'cost'        => $cost,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];
            }

            OverheadCost::insert($costList);
            DB::connection()->getPdo()->commit();
        } catch (Exception $ex) {
            DB::connection()->getPdo()->rollback();
        }

        return true;
    }
}