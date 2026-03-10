<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Farm;
use Illuminate\Http\Request;
use App\Services\FieldService;
use App\DTO\Field\FieldStoreData;
use App\DTO\Field\FieldUpdateData;
use App\Http\Requests\FieldStoreRequest;
use App\Http\Requests\FieldUpdateRequest;

class FieldController extends Controller
{
    private $service;

    public function __construct(FieldService $fieldService)
    {
        $this->service = $fieldService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $fields = Field::query()
            ->with(['farm:id,name'])
            ->whereHas('farm', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.fields.index', compact('fields'));
    }

    public function create()
    {
        $farms = Farm::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('layouts.fields.create', compact('farms'));
    }

    public function store(FieldStoreRequest $request)
    {
        $data = FieldStoreData::fromRequest($request->validated());

        $this->service->store($data);

        return redirect()
            ->route('fields.index')
            ->with('success', 'Talhão criado com sucesso.');
    }

    public function edit($id)
    {
        $field = Field::with('farm')
            ->whereHas('farm', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->findOrFail($id);

        $farms = Farm::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('layouts.fields.edit', compact('field', 'farms'));
    }

    public function update(FieldUpdateRequest $request, $id)
    {
        $data = FieldUpdateData::fromRequest(
            $request->validated(),
            $id
        );

        $this->service->update($data);

        return redirect()
            ->route('fields.index')
            ->with('success', 'Talhão atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('fields.index')
            ->with('success', 'Talhão removido com sucesso.');
    }
}
