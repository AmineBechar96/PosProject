<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Register;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $perPage = FacadesRequest::input('per_pages');
        if ($perPage == null) {
            $perPage = 5;
        }
        $purchases = Purchase::query()
            ->when(FacadesRequest::has('column'), function ($query) {
                $query->orderBy(FacadesRequest::input('column'), FacadesRequest::input('direction'));
            })
            ->join('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
            ->join('users', 'users.id', '=', 'purchases.created_by')
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->select('purchases.*', 'users.username', 'suppliers.name')
            ->paginate($perPage)
            ->withQueryString();
            return Inertia::render('PurchaseScreen', [
                'purchases' => $purchases,'products' => $products, 'suppliers' => $suppliers, 'page_name' => 'purchases', 'filters' => FacadesRequest::only(['search', 'per_pages'])
            ]);
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

    public function create_invoice($id)
    {
        $purchase = Purchase::find($id);
        $products = $purchase->products;
        $supplier = Supplier::find($purchase->supplier_id);
        $user = Setting::find(1);
        return Inertia::render('InvoiceScreen', [
            'data' => $purchase, 'products' => $products,'supplier'=>$supplier,'user' => $user,'page_name' =>'/purchases'
        ]);
    }
    public function create_ticket($id)
    {
        $purchase = Purchase::find($id);
        $products = $purchase->products;
        $supplier = Supplier::find($purchase->supplier_id);
        $user = Setting::find(1);
        return ['data' => $purchase, 'products' => $products,'buyer'=>$supplier,'user' => $user,'buyer_name'=>'Supplier'];
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
                        "product_id" => $product["product_id"],
                        "quantity" => $product["quantity"],
                        "price" => $product["price"],
                        "warehouse_id" => $request["warehouse_id"]
                    );
                    Stock::create($stocks);
                }
            }
            $producto = Product::find($product["product_id"]);
            $producto->price = $product["price"];
            $producto->save();
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
        $purchase = Purchase::find($id);
        $items = $purchase->products;
        $supplier = Supplier::find($purchase->supplier_id);
        $user = User::find($purchase->created_by);
        $payements = $purchase->payementOutcomes;
        $payements= $payements->map(function ($item, $key) {
            $users = User::all();
            $single_user = $users->where('id',$item->created_by);
            return collect($item)->merge($single_user);
        });
        return ['user'=>$user,'data'=>$purchase,'items'=>$items,'payements'=>$payements];
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
        $setting = Setting::find(1);
        return ['purchase' => $purchase, 'items' => $items, 'supplier' => $supplier, 'payements' => $payements,'setting'=>$setting];
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
        $request["updated_at"] = $date;
        Purchase::find($id)->update($request->json()->all());
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
    }
}
