<?php

namespace GaziWorks\Performance\Http\Controllers;

use GaziWorks\Performance\Data\Repositories\OverheadRepository;
use GaziWorks\Performance\Http\Requests\CreateOverheadRequest;
use Illuminate\Http\Request;

use GaziWorks\Performance\Http\Requests;

class OverheadController extends Controller
{
    private $repo;

    public function __construct(OverheadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $overheads = $this->repo->getGroupedTitles();
        return view('overheads.index', compact('overheads'));
    }

    public function create(Request $request)
    {
        $group_id = $request->get('overhead_group_id', null);
        $groups = $this->repo->listGroups();
        return view('overheads.create', compact('groups', 'group_id'));
    }

    public function store(CreateOverheadRequest $request)
    {
        $this->repo->storeTitle($request);

        return redirect()->route('overheads.index');
    }

    public function show($id)
    {
        $title = $this->repo->findTitle($id);

        return view('overheads.show', compact('title'));
    }

    public function edit($id)
    {
        $title = $this->repo->findTitle($id);
        $groups = $this->repo->listGroups();

        return view('overheads.edit', compact('title', 'groups'));
    }

    public function update(CreateOverheadRequest $request, $id)
    {
        $this->repo->updateTitle($id, $request);

        return redirect()->route('overheads.index');
    }


    public function destroy($id)
    {
        $this->repo->deleteTitle($id);

        return redirect()->route('overheads.index');
    }
}
