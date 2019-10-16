<?php

namespace App\Http\Controllers;

use App\Services\ProductTypeService;

class ProductTypeController extends Controller
{

    protected $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function index()
    {
        return view('product_type.index');
    }

    public function create()
    {
        return view('product_type.create');
    }

    public function edit($id)
    {
        $productType = $this->productTypeService->getById($id);
        return view('product_type.edit', compact('productType'));
    }
}
