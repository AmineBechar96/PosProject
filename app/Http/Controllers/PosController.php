<?php

namespace App\Http\Controllers;

use App\Models\ComboItem;
use App\Models\Hold;
use App\Models\Option;
use App\Models\Posale;
use App\Models\Product;
use App\Models\Register;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Table;
use App\Models\Waiter;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        $posales = Posale::where('status', 1)->get();
        $registers = Register::all();
        $stocks = Stock::all();
        $categories = Category::all();


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
    public function updatePosale(Posale $posale, int $quantity)
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
                    $this->updatePosale($posale, $posale->quantity + 1);
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
                    $this->updatePosale($posale, $posale->quantity + 1);
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

    public function addPosaleOptions(Request $request)
    {
        $options1 = $request['options'];
        $posaleid = $request['posale'];
        $posale = Posale::find($posaleid);
        $price_options = 0;

        foreach ($options1 as $value) {
            $datas = Option::where('id', $value)->get();
            foreach ($datas as $price)
                $price_options = $price_options + $price->price;
        }
        $posales2 = Posale::where(['product_id' => $posale->product_id, 'table_id' => $posale->table_id, 'register_id' => $posale->register_id])->where('id', '!=', $posaleid)->get();

        if (!$posales2->isEmpty()) {
            foreach ($posales2 as $posa) {
                if ($posa->options->count() != count($options1)) {
                    $options_exist = false;
                } else {
                    foreach ($options1 as $option1) {
                        $options_exist = $posa->options->contains($option1);
                        if (!$options_exist) {
                            break;
                        }
                    }
                }
            }
            if ($options_exist) {
                $posa->price = $price_options + $posa->price;
                $posa->quantity =  $posa->quantity +  $posale->quantity;
                $posa->time = date("Y-m-d H:i:s");
                $posa->save();
                Posale::where('id', $posale->id)->delete();
            } else {
                $posale->price = $price_options + $posale->price;
                $posale->time = date("Y-m-d H:i:s");
                $posale->options->sync($options1);
                $posale->save();
            }
        } else {
            $posale->price = $price_options + $posale->price;
            $posale->time = date("Y-m-d H:i:s");
            $posale->options()->sync($options1);
            $posale->save();
        }
        return response(['success' => true]);
    }

    public function showTicket(Request $request)
    {
        // $hold = Hold::find($num);
        $waiterN = $request['waiter_id'] > 0 ? Waiter::find($request['waiter_id'])->name : 'withoutWaiter';
        $store = Store::find($request['store_id']);
        $tableN = Table::find($request['table_id'])->name;
        $posales = Posale::where(['status' => 1, 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->get();

        return (['waiterN' => $waiterN, 'store' => $store, 'tableN' => $tableN, 'posales' => $posales]);
    }


    public function showticketKit(Request $request)
    {
        if ($request['id'] == 1) {
            $table = Table::find($request['table_id']);
            $posales = [];
            $products = Product::with('posales', 'category')->get();
            foreach ($products as $product)
                if ($product->category->display == 0 && !$product->posales->isEmpty())
                    foreach ($product->posales as $pos)
                        if ($pos->table_id == $request['table_id'])
                            array_merge($posales, $pos);
            $table->checked = date("Y-m-d H:i:s");
            $table->save();
        } else {
            $posales = Posale::where(['number' => $request['table_id'], 'table_id' => 0, 'register_id' => $request['register_id']])->order('time')->get();
            Posale::where(['number' => $request['table_id'], 'table_id' => 0, 'register_id' => $request['register_id']])->update(['time_visit' => date("Y-m-d H:i:s")]);
        }


        foreach ($posales as $posale) {
            $d1 = $posale->time;
            $d2 = $posale->time_visit;
            if ($d1 < $d2) {
                $posale->time = 'y';
            } else {
                $posale->time = 'n';
            }
        }


        return ['posales' => $posales];
    }

    public function getoptions($id, $posale)
   {
      $options = Option::where('product_id',$id)->get();
      $poOptions = Posale::find($posale)->options;
      
      
      return ['poOptions'=>$poOptions,'options'=>$options];
   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $setting = Setting::find(1)->select('currency');
        $posales = Posale::where('status', 1)->get();
        $registers = Register::all();
        $stocks = Stock::all();
        $categories = Category::all();

        return Inertia::render('PosScreen', ['currency' => $setting, 'posales' => $posales, 'registers' => $registers, 'stocks' => $stocks,'categories' => $categories]);
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
        if ($product->type == 0) {
            $register = Register::find($request["register_id"]);
            $stock = Stock::where(['store_id' => $register->store_id, 'product_id' =>  $posale->product_id])->first();
            $quantity = $stock ? $stock->quantity : 0;
            if ($request['quantity'] <= $quantity) {
                $this->updatePosale($posale, $request['quantity']);
                return response(['success' => true]);
            } else {
                return response(['error' => 'stock']);
            }
        } else if ($product->type == 1) {
            $this->updatePosale($posale, $request['quantity']);
            return response(['success' => true]);
        } else {
            $storeId = $request['store_id'];
            $quantity = 0;
            $combos = ComboItem::where('product_id', $product->id)->get();
            foreach ($combos as $combo) {

                $prd = Product::find($combo->item_id);
                if ($prd->type == 0) {

                    $stock = Stock::where(['store_id' => $storeId,  'product_id' => $combo->item_id])->first();
                    $diff = $stock ? ($stock->quantity - $combo->quantity * ($request['quantity'])) : 1;
                    $quantity = $stock ? ($diff >= 0 ? 1 : 0) : $quantity;
                }
            }
            if ($quantity > 0) {
                $this->updatePosale($posale, $request['quantity']);
                return response(['success' => true]);
            } else {
                return response(['error' => 'stock']);
            }
        }
    }

    public function subTot(Request $request)
    {
        $posales = Posale::where(['status' => 1, 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->get();

        $sub = 0;
        foreach ($posales as $posale) {
            $sub += $posale->price * $posale->quantity;
        }
        return ["subTotal" => $sub];
    }

    public function totPosales(Request $request)
    {
        $posales = Posale::where(['status' => 1, 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->get();
        $sub = 0;
        foreach ($posales as $posale) {
            $sub += $posale->quantity;
        }
        return ["totPosale" => $sub];
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
        Posale::where(['status' => 1, 'register_id' => $id])->delete();
        return response(['success' => true]);
    }
}
