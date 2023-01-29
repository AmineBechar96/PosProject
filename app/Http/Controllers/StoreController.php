<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return Inertia::render('StoreScreen', ['stores'=>$stores]);
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
            'name'=>'required|string|max:40',
            'phone'=>'required|phone|max:40',
            'email'=>'required|string|max:40',
            'address'=>'required|string|max:400',
            'footer_text'=>'required|string|max:400',
            'city'=>'required|string|max:40',
            'country'=>'required|string|max:40',
        ]);
    
        throw ValidationException::withMessages(['name' => 'This Category Exists !']);
        Store::create($data);
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
        $stores = Store::find($id)->get();
        return Response(['stores'=>$stores]);
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
            'name'=>'required|string|max:40',
            'phone'=>'required|phone|max:40',
            'email'=>'required|string|max:40',
            'address'=>'required|string|max:400',
            'footer_text'=>'required|string|max:400',
            'city'=>'required|string|max:40',
            'country'=>'required|string|max:40',
        ]);
        Store::where('id',$id)->update([$data]);
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
        Store::destroy($id);
        return response(['success'=>true]);
    }
}
