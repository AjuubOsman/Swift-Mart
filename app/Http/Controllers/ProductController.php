<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get()->all();
        $categories = Categories::get()->all();

        return view('products/index', compact('products','categories'));
    }
    public function create(Request $request)
    {
        $request->merge(['price' => str_replace(',', '.', $request->price)]);

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'inventory' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validatedData);

        return redirect()->route('products')->with('message', 'Product added successfully!');
    }
    public function edit(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'inventory' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::find($validatedData['id']);

        if ($product) {
            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'inventory' => $validatedData['inventory'],
                'category_id' => $validatedData['category_id'],
            ]);
        }
        return redirect()->route('products')->with('message', 'Product Succesfully Updated');

    }

}
