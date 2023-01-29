<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        return Inertia::render('ProductScreen', [
            'products' => $products, 'categories' => $categories, 'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        $store = Store::all();
        return ["warehouses" => $warehouses, "store" => $store];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $options1 = $request->json()->get("options");
        $request->json()->remove("options");
        $product = Product::create($request->json()->all());
        foreach ($options1 as $option) {
            $product_op = new Option($option);
            $product->options()->save($product_op);
        }
        return ["success" => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Product::find($id);
      $setting = Setting::find(1);
      $store_products = $product->stores();
      $stocks = $product->stocks();
      return(['product'=>$product,'setting'=>$setting,'store_products'=>$store_products,'stocks'=>$stocks,]);
    
    }



    /* Stock Methods */

    public function createStock(Request $request)
    {
        $quant = $request['quant'];
        $quantw = $request['quantw'];
        $pricest = $request['pricest'];
        $productID = $request['product_id'];

        if ($quant) {
            foreach ($quant as $qt) {
                $item = Stock::where(['store_id' => $qt['store_id'], 'product_id' => $productID])->first();
                if (!$item->isEmpty()) {
                    $item->quantity = $qt['quantity'];
                    $item->save();
                } else {
                    $qt['product_id'] = $productID;
                    Stock::create($qt);
                }
            }
        }
        if ($pricest) {
            foreach ($pricest as $pr) {
                $item = Stock::where(['store_id' => $pr['store_id'], 'product_id' => $productID])->first();
                if (!$item->isEmpty()) {
                    $item->price = $pr['price'];
                    $item->save();
                } else {
                    $pr['product_id'] = $productID;
                    Stock::create($pr);
                }
            }
        }
        if ($quantw) {
            foreach ($quantw as $qt) {
                $item = Stock::where(['warehouse_id' => $qt['warehouse_id'], 'product_id' => $productID])->first();
                if (!$item->isEmpty()) {
                    $item->quantity = $qt['quantity'];
                    $item->save();
                } else {
                    $qt['product_id'] = $productID;
                    Stock::create($qt);
                }
            }
        }
    }

    public function updateStock($id){
        $warehouses = Warehouse::all();
        $stores = Store::all();
        $stockStore = [];
        $stockWarehouse = [];

        foreach ($stores as $store) {
            $stock = Stock::where(['store_id' => $store->id , 'product_id' => $id])->first();
            array_merge($stockStore,$stock);
        }
        foreach ($warehouses as $warehouse) {
            $stock = Stock::where(['warehouse_id' => $warehouse->id , 'product_id' => $id])->first();
            array_merge($stockWarehouse,$stock);
        }
        return ['stores'=>$stores,'warehouses'=>$warehouses];

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = false)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        $product = Product::find($id);
        $options = $product->options;
        return response(['categories' => $categories, 'suppliers' => $suppliers, 'product' => $product, 'options' => $options]);
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

        $categories = Category::all();
        $suppliers = Supplier::all();

        $options1 = $request->json()->get("options");
        $request->json()->remove('options');
        $product = Product::find($id)->update($request->json()->all());
        $product = Product::find($id);
        $product->options()->delete();
        foreach ($options1 as $option) {
            $product_op = new Option($option);
            $product->options()->save($product_op);
        }
        return ["success" => true];
    }

    public function makePrdInvis($id, $store_id){
        $product = Product::find($id);
        if($product->stores()->where('store_id', $store_id)->exists()){
            $product->stores()->detach($store_id);
        }
        else{
            $product->stores()->attach($store_id);
        }
        return ["success" => true];
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
    }
}
