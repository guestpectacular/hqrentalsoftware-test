<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{

    public function index(ProductRequest $request)
    {

        $data = (object) $request->validationData();

        // Filter by category...
        if ($request->has('category')) {
            $query = $data->category->products();
        } else {
            $query = Product::query();
        }

        // Filter by price...
        if ($request->has('price')) {
            $query->where('price', $data->limit, $data->price);
        }

        return ProductResource::collection($query->with('categories')->get());
    }

}
