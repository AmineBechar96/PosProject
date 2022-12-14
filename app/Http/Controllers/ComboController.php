<?php

namespace App\Http\Controllers;

use App\Models\ComboItem;
use Illuminate\Http\Request;

class ComboController extends Controller
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
    $data = $request->validate([
            'quantity'=>'required|int',]);  

    if ($data['items']) {
        ComboItem::where('product_id', $data['product_id'])->delete();
        foreach ($data['items'] as $item) {
            $item['product_id'] = $data['product_id'];
            unset($item['code']);
            unset($item['name']);
            ComboItem::create($item);
            return response(['success'=>true]);
         }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $combos = ComboItem::where('product_id',$id)->get();
        $product = ComboItem::where('product_id',$id)->product()->get();
        return Response(['combos'=>$combos,'product'=>$product]);
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
        //
    }
}
