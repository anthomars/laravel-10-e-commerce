<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('dashboard.products.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_descriptions' => 'required',
            'photo' => 'image|file|max:3072',
            'price' => 'required|numeric',
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('products');
        }

        Product::create($validatedData);
        return redirect('/dashboard/products')->with('success', 'New Product succesfully added');
    }

    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'product' => $product,
            'products' => Product::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'product_name' => 'required',
            'product_descriptions' => 'required',
            'photo' => 'image|file|max:3072',
            'price' => 'required|numeric',
        ];


        $validatedData = $request->validate($rules);

        if($request->file('photo')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['photo'] = $request->file('photo')->store('products');
        }

        Product::where('id', $product->id)
            ->update($validatedData);
        return redirect('/dashboard/products')->with('success', 'Product succesfully updated!');
    }

    public function destroy(Product $product)
    {
        if($product->photo) {
            Storage::delete($product->photo);
        }
        Product::destroy($product->id);
        return redirect('/dashboard/products')->with('success', 'Product has been deleted!');
    }
}
