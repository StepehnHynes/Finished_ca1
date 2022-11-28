<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $products = Product::where('user_id', Auth::id())->latest()->paginate(5);
         return view('products.index')->with('products', $products);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        Product::create([
        'user_id' => Auth::id(),
        'uuid' => Str::uuid(),
        'title' => $request->title,
        'text' => $request->text,

    ]);

        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if($product->user_id != Auth::id()) {
            return abort(403);
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product->user_id != Auth::id()) {
            return abort(403);
        }

        return view('products.edit')->with('product', $product);
    }

        //


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($product->user_id != Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        $product->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);
        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->user_id != Auth::id()) {
            return abort(403);
        }


        $product->delete();

        return to_route('products.index', $product)->with('success', 'Product deleted successfully');
    }
}
