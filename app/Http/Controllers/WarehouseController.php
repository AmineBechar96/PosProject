<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return Response(['warehouses'=>$warehouses]);
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
            'name'=>$request->has('name') ? 'required|string|max:100|unique:warehouses':'',
            'phone'=>$request->has('phone') ?'required|phone|max:20':'',
            'email'=> $request->has('email') ?'required|string|max:200':'',
            'address'=>$request->has('address') ?'required|string|max:400':'',
        ]);
    
        Warehouse::create($data);
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
        $warehouses = Warehouse::find($id)->get();
        return Response(['warehouses'=>$warehouses]);
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
            'name'=>$request->has('name') ? 'required|string|max:100|unique:warehouses':'',
            'phone'=>$request->has('phone') ?'required|phone|max:20':'',
            'email'=>$request->has('email') ?'required|string|max:200':'',
            'address'=>$request->has('address') ?'required|string|max:400':'',
        ]);
        if(count($data)>0)
        Warehouse::where('id',$id)->update([$data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::destroy($id);
    }
}
