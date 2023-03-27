<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
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
        $perPage = FacadesRequest::input('per_pages');
        if ($perPage == null) {
            $perPage = 5;
        }
        $customers = Customer::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when(FacadesRequest::has('column'), function ($query) {
                $query->orderBy(FacadesRequest::input('column'), FacadesRequest::input('direction'));
            })
            ->paginate($perPage)
            ->withQueryString();
        return Inertia::render('People/AllPeopleScreen', [
            'page_name' => 'Customers', 'data' => $customers ,'filters' => FacadesRequest::only(['search', 'per_pages'])
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
            'name' => 'required|string|max:50|unique:customers,name',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:50',
            'discount' => 'required|int|max:100'
        ]);
        Customer::create($data);
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
            'name' => $request->has('name') ?'required|string|max:50|unique:customers,name':'',
            'phone' => $request->has('phone') ?'required|max:30':'',
            'email' => $request->has('email') ?'required|email|max:50':'',
            'discount' => $request->has('discount') ?'int|max:100':'',
        ]);
        if(count($data)>0)
        Customer::where('id', $id)->update($data);
       
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
    }
}
