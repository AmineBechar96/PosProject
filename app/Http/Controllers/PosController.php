<?php

namespace App\Http\Controllers;

use App\Models\ComboItem;
use App\Models\Posale;
use App\Models\Product;
use App\Models\Register;
use App\Models\Setting;
use App\Models\Stock;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::find(1)->select('currency');
        $posales = Posale::where('status', 1,)->get();
        $registers = Register::all();
        $stocks = Stock::all();
        return Response(['setting' => $setting, 'posales' => $posales, 'registers' => $registers, 'stocks' => $stocks]);
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
    public function getPosale(int $register_id, int $product_id, int $table_id)
    {
        $posale = Posale::where(['status' => 1, 'register_id' => $register_id, 'product_id' => $product_id, 'table_id' => $table_id])->orderBy('id', 'desc')
            ->first();
        return $posale;
    }
    public function updatePosale(Posale $posale,int $quantity)
    {
        $posale->quantity = $quantity;
        $posale->time = date("Y-m-d H:i:s");
        $posale->save();
    }
    public function createPosale(Request $request, int $price)
    {
        $request["price"] = $price;
        $request["quantity"] = 1;
        $request["status"] = 1;
        Posale::create(
            $request->all(),
        );
        return true;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request['product_id']);
        $postPrice = $request['price'];
        $price = !$product->taxmethod || $product->taxmethod == '0' ? floatval($postPrice) : floatval($postPrice) * (1 + $product->tax / 100);
        $storeId = $request['store_id'];
        unset($request['store_id']);
        if ($product->type == 0) {
            $stock = Stock::where(['store_id' => $storeId,  'product_id' => $product->id])->first();

            $quantity = $stock ? $stock->quantity : 0;
            $posale = $this->getPosale($request['register_id'], $request['product_id'], $request['table_id']);
            if ($posale /*&& $posale->options == null*/) {
                if ($posale->quantity <= $quantity) {
                    $this->updatePosale($posale,$posale->quantity + 1);
                    return response(['success' => true]);
                } else {
                    return response(['error' => 'stock']);
                }
            } else if ($quantity != 0) {
                $this->createPosale($request, $price);
                return response(['success' => true]);
            } else {
                return response(['error' => 'stock']);
            }
        } else if ($product->type == 1) {
            $posale = $this->getPosale($request['register_id'], $request['product_id'], $request['table_id']);
            if ($posale /*&& $posale->options == null*/) {
                $this->updatePosale($posale, $posale->quantity + 1);
                return response(['success' => true]);
            } else {
                $this->createPosale($request, $price);
                return response(['success' => true]);
            }
        } else {
            $posale = $this->getPosale($request['register_id'], $request['product_id'], $request['table_id']);
            $quantity = 0;
            $combos = ComboItem::where('product_id', $product->id)->get();
            foreach ($combos as $combo) {
                $prd = Product::find($combo->item_id);
                if ($prd->type == 0) {
                    $stock = Stock::where(['store_id' => $storeId,  'product_id' => $combo->item_id])->first();
                    if ($posale)
                        $diff = $stock ? ($stock->quantity - $combo->quantity * ($posale->quantity + 1)) : 1;
                    else
                        $diff = $stock ? ($stock->quantity - $combo->quantity) : 1;
                    $quantity = $stock ? ($diff >= 0 ? 1 : 0) : $quantity;
                }
            }
            if ($posale /*&& $posale->options == null*/) {
                if ($quantity > 0) {
                    $this->updatePosale($posale,$posale->quantity + 1);
                    return response(['success' => true]);
                } else {
                    return response(['error' => 'stock']);
                }
            } else if ($quantity > 0) {
                $this->createPosale($request, $price);
                return response(['success' => true]);
            } else {
                return response(['error' => 'stock']);
            }
        }
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
        //
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
        $posale = Posale::find($id);
        $product = Product::find($posale->product_id);
        print($product->type);
        if ($product->type == 0) {
            $register = Register::find($request["register_id"]);
            $stock = Stock::where(['store_id' => $register->store_id, 'product_id' =>  $posale->product_id])->first();
            $quantity = $stock ? $stock->quantity : 0;
            if ($request['quantity'] <= $quantity) {
                $this->updatePosale($posale,$request['quantity']);
                return response(['success' => true]);
            } else {
                return response(['error' => 'stock']);
            }
        }
        else if ($product->type == 1){
            $this->updatePosale($posale,$request['quantity']);
            return response(['success' => true]);
        }
        else {
        $storeId = $request['store_id'];
        $quantity = 0;
        $combos = ComboItem::where('product_id', $product->id)->get();
        foreach ($combos as $combo) {
            
            $prd = Product::find($combo->item_id);
            if($prd->type == 0){
                
                $stock = Stock::where(['store_id' => $storeId,  'product_id' => $combo->item_id])->first();
                $diff = $stock ? ($stock->quantity - $combo->quantity*($request['quantity'])) : 1;
                $quantity = $stock ? ($diff >= 0 ? 1 : 0) : $quantity;
            }
        }
           if($quantity > 0) {
            $this->updatePosale($posale,$request['quantity']);
            return response(['success' => true]);
        }else {
            return response(['error' => 'stock']);
        }
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posale::destroy($id);
        return response(['success' => true]);
    }
    public function resetPos($id)
    {
        Posale::where(['status' => 1 , 'register_id' => $id])->delete();
        return response(['success' => true]);
    }
}
