<?php

namespace App\Http\Controllers;

use App\DTO\Product\ProductStoreData;
use App\DTO\Product\ProductUpdateData;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\ActiveIngredient;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $service;

    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $products = Product::query()
            ->with([
                'manufacturer:id,name',
                'activeIngredients:id,name'
            ])
            ->select([
                'id',
                'name',
                'manufacturer_id'
            ])
            ->search($search)
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.products.index', compact('products'));
    }

    public function create()
    {
        return view('layouts.products.create', [
            'manufacturers' => Manufacturer::orderBy('name')->get(),
            'activeIngredients' => ActiveIngredient::orderBy('name')->get(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $data = ProductStoreData::fromRequest(
            $request->validated()
        );

        $this->service->store($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $product = Product::with('activeIngredients')->findOrFail($id);

        return view('layouts.products.edit', [
            'product' => $product,
            'manufacturers' => Manufacturer::orderBy('name')->get(),
            'activeIngredients' => ActiveIngredient::orderBy('name')->get(),
        ]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $data = ProductUpdateData::fromRequest(
            $request->validated(),
            $id
        );

        $this->service->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto removido com sucesso.');
    }
}
