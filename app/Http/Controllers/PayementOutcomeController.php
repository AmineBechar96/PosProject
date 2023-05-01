<?php

namespace App\Http\Controllers;

use App\Models\PayementOutcome;
use App\Models\Purchase;
use App\Models\Register;
use App\Models\Store;
use App\Models\Setting;
use Illuminate\Http\Request;

class PayementOutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request['purchase_id'] = $request['data_id'];
        unset($request['data_id']);
        if ($request['paid'] == '0')
        return;
        $type = $request['type'];
        $setting = Setting::find(1);
        date_default_timezone_set($setting->timezone);
        $date = date("Y-m-d H:i:s");
        $request['date'] = $date;
        $register = Register::find($request['register_id']);
        $store = Store::find($register->store_id);
        if ($type == 2) {
            //Stripe
        }

        unset($request['carddate']);
        unset($request['cvv']);
        
        if ($type != 2) {
            unset($request['credit_card_holder']);
            if ($type == 0){
                unset($request['credit_card_number']);  
            }
        }
        PayementOutcome::create($request->json()->all());
        $purchase = Purchase::find($request['purchase_id']);

        $purchase->paid = $purchase->paid + $request['paid'];
        $status = $purchase->paid - $purchase->total;
        $purchase->status = $status >= 0 ? 0 : 2;
        $purchase->save();
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
        $payements = $purchase->payementOutcomes();
        return ["purchase" => $purchase, "payements" => $payements];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payement = PayementOutcome::find($id);
        $purchase = Purchase::find($payement->purchase_id);
        $purchase->paid = $purchase->paid - $payement->paid;
        $status = $purchase->paid - $purchase->total;
        $purchase->status = $status <= 0 ? 1 : 2;
        $purchase->save();
        PayementOutcome::destroy($id);
    }
}
