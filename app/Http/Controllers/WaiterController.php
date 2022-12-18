<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        $waiters = Waiter::all();
        return Response(['store' => $stores, 'waiters' => $waiters]);
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
            'name'=>'required|string|max:50',
            'phone'=>'required|phone|max:30',
            'email'=>'required|string|max:50',
        ]);
    
        throw ValidationException::withMessages(['name' => 'This Category Exists !']);
        Waiter::create($data);
        return response(['success'=>true]);
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
        $waiter = Waiter::find($id)->get();
        return Response(['waiter'=>$waiter]);
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
            'name'=>'required|string|max:50',
            'phone'=>'required|phone|max:30',
            'email'=>'required|string|max:50',
        ]);
        Waiter::where('id',$id)->update([$data]);
        return response(['success'=>true]);
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
        return response(['success'=>true]);
    }
}
