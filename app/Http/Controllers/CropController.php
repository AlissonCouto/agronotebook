<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Services\CropService;
use App\DTO\Crop\CropStoreData;
use App\DTO\Crop\CropUpdateData;
use App\Http\Requests\CropStoreRequest;
use App\Http\Requests\CropUpdateRequest;

class CropController extends Controller
{
    private $service;

    public function __construct(CropService $cropService)
    {
        $this->service = $cropService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $crops = Crop::query()
            ->with(['field:id,name'])
            ->whereHas('field.farm', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.crops.index', compact('crops'));
    }

    public function create()
    {
        $fields = Field::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->orderBy('name')->get();

        return view('layouts.crops.create', compact('fields'));
    }

    public function store(CropStoreRequest $request)
    {
        $data = CropStoreData::fromRequest($request->validated());

        $this->service->store($data);

        return redirect()
            ->route('crops.index')
            ->with('success', 'Cultura criada com sucesso.');
    }

    public function edit($id)
    {
        $crop = Crop::with('field')
            ->whereHas('field.farm', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->findOrFail($id);

        $fields = Field::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->orderBy('name')->get();

        return view('layouts.crops.edit', compact('crop', 'fields'));
    }

    public function update(CropUpdateRequest $request, $id)
    {
        $data = CropUpdateData::fromRequest(
            $request->validated(),
            $id
        );

        $this->service->update($data);

        return redirect()
            ->route('crops.index')
            ->with('success', 'Cultura atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('crops.index')
            ->with('success', 'Cultura removida com sucesso.');
    }
}
