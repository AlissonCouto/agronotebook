<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Product;
use App\Models\Field;
use App\Models\Crop;
use App\Services\ApplicationService;
use App\DTO\Application\ApplicationStoreData;
use App\DTO\Application\ApplicationUpdateData;
use App\Http\Requests\ApplicationStoreRequest;
use App\Http\Requests\ApplicationUpdateRequest;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    private $service;

    public function __construct(ApplicationService $applicationService)
    {
        $this->service = $applicationService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'application_date');
        $direction = $request->get('direction', 'desc');

        $applications = Application::query()
            ->with([
                'product:id,name',
                'field:id,name',
                'crop:id,name'
            ])
            ->where('created_by', auth()->id())

            ->when($search, function ($query) use ($search) {

                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })

                    ->orWhereHas('field', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('crop', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })

            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('layouts.applications.create', [
            'products' => Product::orderBy('name')->get(),
            'fields' => Field::orderBy('name')->get(),
            'crops' => Crop::orderBy('name')->get()
        ]);
    }

    public function store(ApplicationStoreRequest $request)
    {
        $data = ApplicationStoreData::fromRequest(
            $request->validated()
        );

        $this->service->store($data);

        return redirect()
            ->route('applications.index')
            ->with('success', 'Aplicação registrada com sucesso.');
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);

        return view('layouts.applications.edit', [
            'application' => $application,
            'products' => Product::orderBy('name')->get(),
            'fields' => Field::orderBy('name')->get(),
            'crops' => Crop::orderBy('name')->get()
        ]);
    }

    public function update(ApplicationUpdateRequest $request, $id)
    {
        $data = ApplicationUpdateData::fromRequest(
            $request->validated(),
            $id
        );

        $this->service->update($data);

        return redirect()
            ->route('applications.index')
            ->with('success', 'Aplicação atualizada.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('applications.index')
            ->with('success', 'Aplicação removida.');
    }
}
