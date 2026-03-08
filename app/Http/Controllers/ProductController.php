<?php

namespace App\Http\Controllers;

use App\DTO\Product\ProductStoreData;
use App\Http\Requests\ProductStoreRequest;
use App\Models\ActiveIngredient;
use App\Models\Manufacturer;
use App\Services\ProductService;

class ProductController extends Controller
{

    private $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    public function index()
    {
        return "INDEX";
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
}
