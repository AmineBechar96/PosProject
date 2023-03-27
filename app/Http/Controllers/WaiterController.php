<?php

namespace App\Http\Controllers;

use App\Models\Hold;
use App\Models\Store;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class WaiterController extends Controller
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
        $stores = Store::all();
        $waiters = Waiter::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when(FacadesRequest::has('column'), function ($query) {
                $query->orderBy(FacadesRequest::input('column'), FacadesRequest::input('direction'));
            })
            ->join('stores', 'stores.id', '=', 'waiters.store_id')
            ->select('waiters.*', 'stores.name as name2')
            ->paginate($perPage)
            ->withQueryString();
        return Inertia::render('People/AllPeopleScreen', [
            'page_name' => 'Waiters', 'data' => $waiters ,'stores' => $stores,'filters' => FacadesRequest::only(['search', 'per_pages'])
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
            'name' => $request->has('name') ?'required|string|max:50|unique:waiters,name':'',
            'phone' => $request->has('phone') ?'required|max:30':'',
            'email' => $request->has('email')? 'required|email|max:50':'',
            'store_id'=> 'int'
        ]);
        if(count($data)>0)
        Waiter::create($data);
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


    public function storeWaiterCash($id)
    {
        $waiters = Waiter::where('store_id', $id)->get();
        return Response(['waiters' => $waiters,]);
    }

    public function waiterName(Request $request, $num = null)
    {
        $hold = Hold::where(['number' => $num, 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->first();
        return Response(['waiter_id' => $hold->waiterid]);
    }

    public function changeWaiters(Request $request)
    {
        $num = $request['num'];
        $id = $request['id'];

        $hold = Hold::where(['number' => $num, 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->first();

        $hold->waiter_id = $id;
        $hold->save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $waiter = Waiter::find($id)->get();
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
            'name' => $request->has('name') ?'required|string|max:50|unique:waiters,name':'',
            'phone' => $request->has('phone') ?'required|max:30':'',
            'email' => $request->has('email')? 'required|email|max:50':''
        ]);
        Waiter::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Waiter::destroy($id);
    }
}
