<?php

namespace App\Http\Controllers;

use App\Models\ComboItem;
use App\Models\Customer;
use App\Models\Hold;
use App\Models\Posale;
use App\Models\Product;
use App\Models\Register;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $perPage = FacadesRequest::input('per_pages');
        if ($perPage == null) {
            $perPage = 5;
        }
        if (FacadesRequest::input('checkbox') != null) {
            $perPage = 5;
        }
        $sales = Sale::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('reference', 'like', "%{$search}%");
            })
            ->when(FacadesRequest::has('column'), function ($query) {
                $query->orderBy(FacadesRequest::input('column'), FacadesRequest::input('direction'));
            })
            ->join('customers', 'customers.id', '=', 'sales.client_id')
            ->join('users', 'users.id', '=', 'sales.created_by')
            ->select('sales.*', 'users.username', 'customers.name')
            ->paginate($perPage)
            ->withQueryString();
        return Inertia::render('SaleScreen', [
            'sales' => $sales, 'customers' => $customers, 'page_name' => 'sales', 'filters' => FacadesRequest::only(['search', 'per_pages'])
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request['type'];
        $tableId = $request['table_id'];
        $setting = Setting::find(1);
        date_default_timezone_set($setting->timezone);
        $date = date("Y-m-d H:i:s");
        $request['created_at'] = $date;
        $register = Register::find($request['register_id']);
        if ($type == 2) {
            try {
                Stripe::setApiKey($this->setting->stripe_secret_key);
                $myCard = [
                    'number' => $request['ccnum'],
                    'exp_month' => $request['ccmonth'],
                    'exp_year' => $request['ccyear'],
                    "cvc" => $request['ccv']
                ];
                $charge = Stripe_Charge::create([
                    'card' => $myCard,
                    'amount' => (floatval($request['paid']) * 100),
                    'currency' => $this->setting->currency
                ]);
                return response(['success' => true]);
            } catch (Stripe_CardError $e) {
                $body = $e->getJsonBody();
                $err = $body['error'];
                return response(['error' => $err]);
            }
        }
        unset($request['ccnum']);
        unset($request['ccmonth']);
        unset($request['ccyear']);
        unset($request['ccv']);
        $paystatus = $request['paid'] - $request['total'];
        $request['first_payement'] = $paystatus > 0 ? $request['total'] : $request['paid'];
        $sale = Sale::create($request);
        $posales = Posale::where(['status' => 1, 'register_id' => $request['register_id'], 'table_id' => $tableId]);
        foreach ($posales as $posale) {
            $data = array(
                "price" => $posale->price,
                "quantity" => $posale->quantity,
                "date" => $date
            );
            $number = $posale->number;
            $register = Register::find($request['register_id']);
            $prod = Product::find($posale->product_id);
            if ($prod->type == 2) {
                $combos = ComboItem::where('product_id', $posale->product_id)->get();
                foreach ($combos as $combo) {
                    $prd = Product::find($combo->item_id);
                    if ($prd->type == 0) {
                        $stock = Stock::where(['store_id' => $register->store_id, 'product_id' => $combo->item_id])->first();
                        $stock->quantity = $stock->quantity - ($combo->quantity * $posale->qt);
                        $stock->save();
                    }
                }
            } else if ($prod->type == 0) {
                $stock = Stock::where(['store_id' => $register->store_id, 'product_id' => $posale->item_id])->first();
                $stock->quantity = $stock->quantity - ($posale->quantity * $posale->qt);
                $stock->save();
            }
            $sale->products()->sync($data);
        }
        Posale::where([['status' => 1, 'register_id' => $request['register_id'], 'table_id' => $tableId]])->delete();

        if (isset($number)) {
            if ($number != 1)
                Hold::where(['number' => $number, 'register_id' => $request['register_id'], 'table_id' => $tableId])->delete();
        }
        $hold = Hold::where(['register_id' => $request['register_id'], 'table_id' => $tableId])->order('asc')->first();
        if ($hold) {
            Posale::where(['number' => $hold->number, 'register_id' => $request['register_id'], 'table_id' => $tableId])->update(['status' => 1]);
        }
        return response(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        $items = $sale->products();
        $client = Customer::find($sale->client_id);
        $payements = $sale->payementIncomes();
        return ['sale'=>$sale,'items'=>$items,'client'=>$client,'payements'=>$payements]; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        $customer = $sale->customer();
        $setting = Setting::find(1);
        return ['customer'=>$customer,'sale'=>$sale,'setting'=>$setting];
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
        Sale::find($id)->update($request->json()->all());
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
        $sale = Sale::find($id);
        $sale->products()->detach();
        Sale::destroy($id);
        return response(['success' => true]);
    }
}
