<?php

namespace App\Http\Controllers;

use Session;

use App\Product;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'image' => 'required|image',
            'price' => 'required',
            'description' => 'required',

        ]);

        $product_image = $request->image;
        $$product_image_new_name = time().$product_image->getClientOriginalName();
        $$product_image->move('uploads/products',$product_image_new_name);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'uploads/posts/' . $product_image_new_name,
            'price' => $request->price
        ]);

        Session::flash('success', 'Product added');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required',
            'image' => 'required|image',
            'price' => 'required',
            'description' => 'required',

        ]);

        $product = Product::find($id);

        if($request->hasFile('image'))
        {

            $product_image = $request->image;
            $product_image_new_name = time().$product_image->getClientOriginalName();
            $product_image->move('uploads/products',$product_image_new_name);

            $product->image = 'uploads/products/'.$product_image_new_name;

        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();

        Session::flash('success', 'Product updated');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(file_exists($product->image))
        {
            unlink($product->image);
        }

        $product->delete();

        Session::flash('success', 'Product Deleted');

        return redirect()->route('products.index');
    }
}
