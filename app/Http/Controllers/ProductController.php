<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    // function show All date in tabel product
    public function index()
    {
        $products = Product::all();
        if ($products->count() > 0) {
            return response()->json([
                'status' => 200,
                'student' => $products,
                200
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No Records Found',
            404
        ]);
    }

    // function add date in tabel product
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->save();
        return response()->json(['message' => "Product Added successfully"], 201);
    }

    // function show oun product with id  in tabel product
    public function show($id)
    {
        $Product = Product::find($id);
        if ($Product) {
            return response()->json([
                'status' => 200,
                'message' => $Product,
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No such product Found!',
        ], 404);
    }

    // function show oun product with id in tabel product
    public function edit($id)
    {
        $Product = Product::find($id);
        if ($Product) {
            return response()->json([
                'status' => 200,
                'message' => $Product,
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No such product Found!',
        ], 404);
    }

    // function update date in tabel product
    public function update(Request $request, $id)
    {

        $product = Product::find($id);
        if ($product) {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->update();
            return response()->json(['message' => "Product updated successfully"], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Something Wrong',
        ], 404);
    }

    // function delete  date in tabel product
    public function distroy($id)
    {

        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => "Product deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'No such product Found!',
        ], 404);
    }
}
