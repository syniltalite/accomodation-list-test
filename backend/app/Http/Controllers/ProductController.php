<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function search(Request $request)
    {
        return response()->json([
            'data' => $this->product->searchProduct($request->filters),
            'status' => 'success',
            'message' => ''
        ], 200);
    }

    public function suburbList(Request $request)
    {
        return response()->json([
            'data' => $this->product->suburbList('suburbs'),
            'status' => 'success',
            'message' => ''
        ], 200);
    }
    public function areaList(Request $request)
    {
        return response()->json([
            'data' => $this->product->areaList('areas'),
            'status' => 'success',
            'message' => ''
        ], 200);
    }
}
