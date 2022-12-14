<?php

namespace App\Http\Controllers;

use App\Models\CategoryExpence;
use App\Models\Expence;
use App\Models\Register;
use App\Models\Store;
use Illuminate\Http\Request;

class ExpenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        $categorie_expences = CategoryExpence::all();
        return Response(['stores'=>$stores,'categorie_expences'=>$categorie_expences]);
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
            'date'=>'required|date',
            'reference'=>'required|string|max:150',
            'note'=>'required|text',
            'amount'=>'required|float|max:60',
            'attachment'=>'string|max:200',
        ]);
        Expence::create($data);
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
        $expence = Expence::find($id);
        $store = $expence->store_id == 0 ? false : Store::find($expence->store_id);
        $storeName = $store ? $store->name : 'Store';
        $stores = Store::all();
        $categories = CategoryExpence::all();
        return Response(['storeName'=>$storeName,'stores'=>$stores,'categories'=>$categories,'expence'=>$expence]);
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
            'date'=>'required|date',
            'reference'=>'required|string|max:150',
            'note'=>'required|text',
            'amount'=>'required|float|max:60',
            'attachment'=>'string|max:200',
        ]);
        Expence::where('id',$id)->update([$data]);
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
        //
    }
}
