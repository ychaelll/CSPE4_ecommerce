<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = \App\Product::orderBy('id', 'DESC')->paginate();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }
    
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->post('name'),
            'stocks' => $request->post('stocks')
        ]);

        return redirect(route('products.index'));
    }

    public function show($id){

        $product = \App\Product::find($id);
        return view('products.show', compact('product'));

    }

    public function edit($id)
    {
        $product = \App\Product::where('id', $id)->first();

        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = \App\Product::findOrFail($id);

        $product->update([
            'name' => $request->post('name'),
            'stocks' => $request->post('stocks'),
        ]);


        return redirect(route('products.index'));
    }

    public function delete($id)
    {
        $product = \App\Product::findOrFail($id);
        $product->delete();


        return redirect(route('products.index'));
    }
}
