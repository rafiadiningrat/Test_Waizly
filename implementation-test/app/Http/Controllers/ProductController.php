<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return response()->json($this->productRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->productRepository->find($id));
    }

    public function store(Request $request)
    {
        $product = $this->productRepository->create($request->all());
        Log::info('Product created: ', ['product' => $product]);
        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->update($id, $request->all());
        Log::info('Product updated: ', ['product' => $product]);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        Log::info('Product deleted: ', ['product_id' => $id]);
        return response()->json(null, 200);
    }
}

