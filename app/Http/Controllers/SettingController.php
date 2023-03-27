<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Store;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        $users = User::all();
        $stores = Store::all();
        return Inertia::render('SettingsScreen', ['stores' => $stores, 'warehouses' => $warehouses, 'users' => $users]);
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
        //
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
        $data = $request->validate([
            'companyname' => $request->has('name') ?'required|string|max:100':'',
            'logo' => $request->has('name') ?'required|string|max:200':'',
            'phone' => $request->has('name') ?'required|string|max:25':'',
            'phone' => $request->has('name') ?'required|string|max:10':'',
            'keyboard' => $request->has('name') ?'required|boolean':'',
            'theme' => $request->has('name') ?'required|string|max:20':'',
            'discount' => $request->has('name') ?'required|int':'',
            'tax' => $request->has('name') ?'required|string|int':'',
        ]);
        if(count($data)>0)
        Setting::where('id', 1)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
