<?php

namespace App\Http\Controllers;

use App\Models\PayementIncome;
use App\Models\PayementOutcome;
use App\Models\Register;
use App\Models\Sale;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Http\Request;

class RegisterController extends Controller
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
        $cash = $this->input->post('cash');
        $id = $this->input->post('store');
        $waitersCach = $this->input->post('waitersCach');
        $waitercc = '';
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
        $register = Register::find($id);
        $user = User::find($register->user_id);
        $sales = Sale::where('register_id', $id)->get();

        $payement_incomes = PayementIncome::where('register_id', $id)->get();

        $waiters = Waiter::where('store_id', $register->store_id)->get();
        $cash = 0;
        $cheque = 0;
        $cc = 0;
        $cashinHand = $register->cash_inhand;
        $cheques = [];
        $ccs = [];
        $cashs = [];
        $Wtotals = [];
        foreach ($payement_incomes as $payement) {
            switch ($payement->type) {
                case 1:
                    $cc += $payement->paid;
                    break;
                case 2:
                    $cheque += $payement->paid;
                    break;
                default:
                    $cash += $payement->paid;
            }
        }
        foreach ($sales as $sale) {
            $paystatus = $sale->paid - $sale->total;
            switch ($sale->type) {
                case 1:
                    $cc += $paystatus > 0 ? $sale->total : $sale->first_payement;
                    break;
                case 2:
                    $cheque += $paystatus > 0 ? $sale->total : $sale->first_payement;
                    break;
                default:
                    $cash += $paystatus > 0 ? $sale->total : $sale->first_payement;
            }
        }

        $cih_waiters = $register->waiters;
        $cachin = 0;
        foreach ($cih_waiters as $cih) {
            $cachin = $cih->pivot->cash_in_hand + $cachin;
        }


        foreach ($waiters as $waiter) {
            $cashw = 0;
            $chequew = 0;
            $ccw = 0;
            foreach ($payement_incomes as $payement) {
                if ($payement->waiter_id == $waiter->id) {
                    switch ($payement->type) {
                        case 1:
                            $ccw += $payement->paid;
                            break;
                        case 2:
                            $chequew += $payement->paid;
                            break;
                        default:
                            $cashw += $payement->paid;
                    }
                }
            }
            foreach ($sales as $sale) {
                if ($sale->waiter_id == $waiter->id) {
                    $paystatus = $sale->paid - $sale->total;
                    switch ($sale->type) {
                        case 1:
                            $ccw += $paystatus > 0 ? $sale->total : $sale->firstpayement;
                            break;
                        case 2:
                            $chequew += $paystatus > 0 ? $sale->total : $sale->firstpayement;
                            break;
                        default:
                            $cashw += $paystatus > 0 ? $sale->total : $sale->firstpayement;
                    }
                }
            }
            $Wtotal = $ccw + $chequew + $cashw + $cachin;
            array_push($Wtotals, $Wtotal);
            array_push($cheques, $cheque);
            array_push($ccs,);
            array_push($cashs, $cash);
        }
        return [
            'Wtotals' => $Wtotals, 'cashinHand' => $cashinHand, 'cash' => $cashs,
            'cheque' => $cheques,
            'cc' => $ccs,'user' =>$user
        ];
    }
}
