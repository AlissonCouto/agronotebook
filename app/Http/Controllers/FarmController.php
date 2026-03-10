<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmStoreRequest;
use App\Http\Requests\FarmUpdateRequest;
use App\Services\FarmService;
use App\Models\Farm;
use App\DTO\Farm\FarmStoreData;
use App\DTO\Farm\FarmUpdateData;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    private $service;

    public function __construct(FarmService $farmService)
    {
        $this->service = $farmService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $farms = Farm::query()
            ->where('user_id', auth()->id())
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.farms.index', compact('farms'));
    }

    public function create()
    {
        return view('layouts.farms.create');
    }

    public function store(FarmStoreRequest $request)
    {
        $data = FarmStoreData::fromRequest($request->validated());

        $this->service->store($data);

        return redirect()
            ->route('farms.index')
            ->with('success', 'Fazenda criada com sucesso.');
    }

    public function edit($id)
    {
        $farm = Farm::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('layouts.farms.edit', compact('farm'));
    }

    public function update(FarmUpdateRequest $request, $id)
    {
        $data = FarmUpdateData::fromRequest(
            $request->validated(),
            $id
        );

        $this->service->update($data);

        return redirect()
            ->route('farms.index')
            ->with('success', 'Fazenda atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('farms.index')
            ->with('success', 'Fazenda removida com sucesso.');
    }
}
