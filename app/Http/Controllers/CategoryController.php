<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return Response(['categories'=>$categories]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:60|unique:categories,name',
        ]);
    
        throw ValidationException::withMessages(['name' => 'This Category Exists !']);
    
        $data['display'] = 0;
        Category::create($data);
        return response(['success'=>true]);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $data = $request->validate([
            'name'=>'required|string|max:60|unique:categories,name',
        ]);
        Category::where('id',$id)->update(['name'=>$data["name"],'display'=>$data["display"]]);
        return response(['success'=>true]);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return response(['success'=>true]);
    }
}
