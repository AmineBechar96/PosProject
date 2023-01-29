<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hold;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return Inertia::render('CustomerScreen', [
            'customers'=>$customers
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
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|phone|max:30',
            'email' => 'required|string|max:50',
            'discount' => 'required|int'
        ]);

        throw ValidationException::withMessages(['name' => 'This Category Exists !']);
        Customer::create($data);
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
        $customer = Customer::find($id);
        return Response(['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return Response(['customer' => $customer]);
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
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:30',
            'email' => 'required|string|max:50',
            'discount' => 'required|int',
        ]);
        Customer::where('id', $id)->update([$data]);
        return response(['success' => true]);
    }

    public function customerName(Request $request)
    {
        $hold = Hold::where(['number' => $request['number'], 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->first();
        return response(['customer_id' => $hold->customer_id]);

    }
    /* not done*/
    public function changeCustomers(Request $request)
    {
        $num = $request['num'];
        $id = $request['id'];

        $hold = Hold::where(['number' => $num, 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->first();

        $hold->customer_id = $id;
        $hold->save();

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
        Customer::destroy($id);
        return response(['success' => true]);
    }
}
