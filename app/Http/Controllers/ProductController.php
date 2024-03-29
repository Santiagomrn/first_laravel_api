<?php

namespace App\Http\Controllers;

use App\Product; //se incluye para usar el model Product Larabel toma como nombre del modelo el plural products
use Illuminate\Http\Request;
use PhpParser\Node\Name;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products=Product::get(); //obtengo los productos de la base de datos utilizando el modelo Product


        return response()->json($products,200); //respondo con un json listando los productos y devolviendo un estatus 200
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request()->validate([
            'name'=>'required',
            'price'=> 'numeric|gte:0|required'
        ]);
        //
        $product = Product::create($request->all());//obtengo todo el contenido del la DB

        // Return a response with a product json
        // representation and a 201 status code
        return response()->json($product,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::findOrFail($id);//busco el producto el la base usando el modelo product
        return response()->json($product,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $product=Product::findOrFail($id);// busco el producto a actualizar con base a la id
        $product->update($request->all());//actualizo el producto

        return response()->json($product,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete();// Destruyo el producto


        return response("",200);
    }
}
