<?php

namespace App\Http\Controllers;

use App\Models\PayementIncome;
use App\Models\Register;
use App\Models\Sale;
use App\Models\Store;
use App\Models\Setting;
use Illuminate\Http\Request;

class PayementIncomeController extends Controller
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
        if ($request['paid'] == '0')
        return;
        dd($request);
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
        PayementIncome::create($request->json()->all());
        $sale = Sale::find($request['sale_id']);

        $sale->paid = $sale->paid + $request['paid'];
        $status = $sale->paid - $sale->total;
        $sale->status = $status >= 0 ? 0 : 2;
        $sale->save();
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
        $payements = $sale->payementIncomes();
        return ["sale" => $sale, "payements" => $payements];
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
        $payement = PayementIncome::find($id);
        $sale = Sale::find($payement->sale_id);
        $sale->paid = $sale->paid - $payement->paid;
        $status = $sale->paid - $sale->total;
        $sale->status = $status === -floatval($sale->total) ? 1 : 2;
        $sale->save();
        PayementIncome::destroy($id);
    }
}
