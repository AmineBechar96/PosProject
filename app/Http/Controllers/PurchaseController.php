<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Register;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return ($purchases);
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
        $products = $request['products'];
        $register_id = $request['register_id'];
        unset($request['products']);
        unset($request['register_id']);

        $purchase = Purchase::create($request->json()->all());
        foreach ($products as $product) {
            if (count($product) != 0) {
                
                $purchase->products()->sync([$product]);

                $register = Register::find($register_id);
                $stock = Stock::where(['store_id' => $register->store_id, 'product_id' => $request['product_id']])->first();
                $quantity = $stock ? $stock->quantity : 0;
                if ($quantity) {
                    $stock->quantity = $quantity + $product['qteop'];
                    $stock->price = $product['qteop'];
                    $stock->save();
                } else {
                    $stocks = array(
                        "store_id" => $register->store_id,
                        "product_id" =>$product["product_id"],
                        "quantity" =>$product["quantity"],
                        "price" => $product["price"],
                        "warehouse_id"=>$request["warehouse_id"]
                    );
                    Stock::create($stocks);
                }
            }
            $producto = Product::find($product["product_id"]);
            $producto->price = $product["price"];
            $producto->save();
        }
        return ['success' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase = Purchase::find($id);
        $items = $purchase->products();
        $supplier = Supplier::find($purchase->supplier_id);
        $payements = $purchase->payementOutcomes();
        return ['purchase' => $purchase, 'items' => $items, 'supplier' => $supplier, 'payements' => $payements];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $items = $purchase->products();
        $supplier = Supplier::find($purchase->supplier_id);
        $payements = $purchase->payementOutcomes();
        return ['purchase' => $purchase, 'items' => $items, 'supplier' => $supplier, 'payements' => $payements];
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
        $setting = Setting::find(1);
        date_default_timezone_set($setting->timezone);
        $date = date("Y-m-d H:i:s");
        $request["modified_at"] = $date;
        Purchase::find($id)->update($request->json()->all());
        return response(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->products()->detach();
        Purchase::destroy($id);
        return response(['success' => true]);
    }
}
