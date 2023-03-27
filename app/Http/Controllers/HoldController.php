<?php

namespace App\Http\Controllers;

use App\Models\Hold;
use App\Models\Posale;
use Illuminate\Http\Request;

class HoldController extends Controller
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
        $hold = Hold::where(['register_id' => $request['register_id'], 'table_id' => $request['table_id'],])->order('asc')->first();
        $number = !$hold->isEmpty() ? intval($hold->number) + 1 : 1;
        Posale::where(['status' => 1, 'register_id' => $request['register_id']])->update(['status' => 0]);
        $attributes = array(
            'number' => $number,
            'time' => date("H:i"),
            'register_id' => $request['register_id'],
            'table_id' => $request['table_id']
        );
        Hold::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    public function holdList(Request $request)
    {
        $holds = Hold::where(['register_id'=> $request['register_id'],'table_id'=>$request['table_id']])->order('asc')->get();
        $posale = Posale::where(['status'=> 1,'register_id'=> $request['register_id'],'table_id'=>$request['table_id']])->get();
        return response(['holds' => $holds,'posale' => $posale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        Posale::where(['status' => 1, 'register_id' => $request["register_id"]])->update(['status' => 0]);
        Posale::where(['number' => $id, 'register_id' => $request["register_id"]])->update(['status' => 1]);
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
    public function removeHold(Request $request)
    {
        $hold = Hold::where(['number' => $request['number'], 'register_id' => $request['register_id'], 'table_id' => $request['table_id']])->first();
        $hold->delete();
        Posale::where(['number' => $request['number'], 'register_id' => $request['register_id']])->delete();
        $hold = Hold::where(['register_id' => $request['register_id'], 'table_id' => $request['table_id'],])->order('asc')->first();

        Posale::where(['number' => $hold->number, 'register_id' => $request['register_id']])->update(['status' => 1]);
    }
}
