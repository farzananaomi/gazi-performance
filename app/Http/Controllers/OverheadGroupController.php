<?php

namespace GaziWorks\Performance\Http\Controllers;

use GaziWorks\Performance\Data\Repositories\OverheadRepository;
use GaziWorks\Performance\Http\Requests\CreateOverheadGroupRequest;
use Illuminate\Http\Request;

use GaziWorks\Performance\Http\Requests;

class OverheadGroupController extends Controller
{
    private $repo;

    public function __construct(OverheadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $groups = $this->repo->getGroups();
        return view('overhead_groups.index', compact('groups'));
    }

    public function create(Request $request)
    {
        return view('overhead_groups.create');
    }

    public function store(CreateOverheadGroupRequest $request)
    {
        $this->repo->storeGroup($request);

        return redirect()->route('overheads.index');
    }

    public function show($id)
    {
        $group = $this->repo->findGroup($id);

        return view('overhead_groups.show', compact('group'));
    }

    public function edit($id)
    {
        $group = $this->repo->findGroup($id);

        return view('overhead_groups.edit', compact('group'));
    }

    public function update(CreateOverheadGroupRequest $request, $id)
    {
        $this->repo->updateGroup($id, $request);

        return redirect()->route('overheads.index');
    }


    public function destroy($id)
    {
        $this->repo->deleteGroup($id);

        return redirect()->route('overheads.index');
    }

}
