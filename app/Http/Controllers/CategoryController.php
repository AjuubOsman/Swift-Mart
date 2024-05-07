<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function create(request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        Categories::create($validatedData);

        return redirect()->route('products')->with('message', 'Category added successfully!');

    }
    public function delete($id)
    {
        $product = Product::where('category_id', $id)->first();
        if ($product){

            return redirect()->route('products')->with('message', 'Category cannot be deleted, a product is linked to this category!');
        }else{
            $category = Categories::where('id', $id)->first();

            $category->delete();
            return redirect()->route('products')->with('message', 'Category Succesfully deleted');

        }

    }
    public function update(Request $request)
    {
        $category = Categories::where('id', $request->input('id'))->first();

        $category->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('products')->with('message', 'Category Succesfully updated');

    }

}
