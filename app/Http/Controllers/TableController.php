<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TableController extends Controller
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
            'name'=>'required|string|max:150',
            'status'=>'required|phone|max:40',
            'time'=>'required|int',
            'checked'=>'required|string|max:50',
        ]);
    
        throw ValidationException::withMessages(['name' => 'This Category Exists !']);
        Table::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tables = Table::where('store_id = ?', $id);
      $zones = Zone::where('store_id = ?', $id);
      return Response(['tables'=>$tables,'zones',$zones]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::find($id)->get();
        $zones = Zone::all();
        return Response(['table'=>$table,'zones'=>$zones]);
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
            'name'=>'required|string|max:150',
            'status'=>'required|phone|max:40',
            'time'=>'required|int',
            'checked'=>'required|string|max:50',
        ]);
        Table::where('id',$id)->update([$data]);
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
        Zone::destroy($id);
        return response(['success'=>true]);
    }
}
