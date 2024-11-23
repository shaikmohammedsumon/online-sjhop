<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'maneger'){
            $products = Product::latest()->paginate(10);
            return view('dashboard.product.index',compact('products'));
        }else{
            $products = Product::where('seller_id',Auth::user()->id)->latest()->paginate(10);
            return view('dashboard.product.index',compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categorys = Category::latest()->get();
        return view('dashboard.product.store',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());

        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'weight' => 'required|integer',
            'country_of_origin' => 'required',
            'quality' => 'required',
            'check' => 'required',
            'min_weight' => 'required|integer',
        ]);

        $newName = Auth::user()->id.'-'.Auth::user()->name.'-'.$request->name.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/upload/products/'.$newName));


        Product::create([
            'seller_id' => Auth::user()->id,
            'image' => $newName,
            'name' => $request->name,
            'price' =>  $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'weight' =>  $request->weight,
            'country_of_origin' => $request->country_of_origin,
            'quality' => $request->quality,
            'check' => $request->check,
            'min_weight' =>  $request->min_weight,


        ]);
        // return back()->with('created', "Product Created SuccessFul");
        return redirect()->route('products.index')->with('created', 'Product Created SuccessFul');


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categorys = Category::latest()->get();
        $product = Product::where('id',$product->id)->first();
        return view('dashboard.product.edit',compact('product','categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $manager = new ImageManager(new Driver());
        $products = Product::where('id',$product->id)->first();

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'weight' => 'required|integer',
            'country_of_origin' => 'required',
            'quality' => 'required',
            'check' => 'required',
            'min_weight' => 'required|integer',
        ]);

        if($request->image){
            $oldPath = base_path('public/upload/products/'.$products->image);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }

            $newName = Auth::user()->id.'-'.Auth::user()->name.'-'.$request->name.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/upload/products/'.$newName));

            Product::find($products->id)->update([
                'image' => $newName,
                'name' => $request->name,
                'price' =>  $request->price,
                'category' => $request->category,
                'description' => $request->description,
                'weight' =>  $request->weight,
                'country_of_origin' => $request->country_of_origin,
                'quality' => $request->quality,
                'check' => $request->check,
                'min_weight' =>  $request->min_weight,
            ]);
            return redirect()->route('products.index')->with('update',"Product Update Successful");

        }else{
            Product::find($products->id)->update([
                'name' => $request->name,
                'price' =>  $request->price,
                'category' => $request->category,
                'description' => $request->description,
                'weight' =>  $request->weight,
                'country_of_origin' => $request->country_of_origin,
                'quality' => $request->quality,
                'check' => $request->check,
                'min_weight' =>  $request->min_weight,
            ]);
            return redirect()->route('products.index')->with('update',"Product Update Successful");

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $products = Product::where('id',$product->id)->first();

        $oldPath = base_path('public/upload/products/'.$products->image);
        if(file_exists($oldPath)){
            unlink($oldPath);
        }

        Product::find( $product->id)->delete();
        return back()->with('action',"Delete Successful");

    }



    public function action($name){
        $product = Product::where('name',$name)->first();

        // return $product->id;
        // die();

        if($product->status == "deactive"){
            Product::find($product->id)->update([
                'status' => 'active',
                'updated_at'=> now(),
            ]);
            return back()->with('action',"Active Successful");

        }else{
            Product::find($product->id)->update([
                'status' => 'deactive',
                'updated_at'=> now(),
            ]);
            return back()->with('action',"Deactive Successful");
        }
    }



    public function organic($name){
        $product = Product::where('name',$name)->first();

        // return $product->id;
        // die();

        if($product->resh_organic_vegetables == "deactive"){
            Product::find($product->id)->update([
                'resh_organic_vegetables' => 'active',
                'updated_at'=> now(),
            ]);
            return back()->with('action',"Fresh Organic Vegetables Active Successful");

        }else{
            Product::find($product->id)->update([
                'resh_organic_vegetables' => 'deactive',
                'updated_at'=> now(),
            ]);
            return back()->with('action',"Fresh Organic Vegetables Deactive Successful");
        }
    }
    public function product_category(Request $request ,$id){
        $product = Product::where('id',$id)->first();


        if($product->product_category == "none"){
            Product::find($product->id)->update([
                'product_category' => $request->product_category,
                'updated_at'=> now(),
            ]);
            return back()->with('action',"this product  selece is $request->product_category Successful");

        }else if($product->product_category == "fruites"){
            Product::find($product->id)->update([
                'product_category' => $request->product_category,
                'updated_at'=> now(),
            ]);
            return back()->with('action'," this product  selece is $request->product_category Successful");
        }else if($product->product_category == "vesitables"){
            Product::find($product->id)->update([
                'product_category' => $request->product_category,
                'updated_at'=> now(),
            ]);
            return back()->with('action',"this product  selece is $request->product_category Successful");
        }

    }
}
