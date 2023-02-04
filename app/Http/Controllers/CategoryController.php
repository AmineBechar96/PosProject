<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Validation\ValidationException;

//use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = FacadesRequest::input('per_pages');
        if($perPage == null){
            $perPage = 5;
        }
        if(FacadesRequest::input('checkbox') != null){
            $perPage = 5;
        }
        $categories = Category::query()
        ->when(FacadesRequest::input('search'),function ($query,$search){
            $query->where('name', 'like' ,"%{$search}%");
        })
        ->when(FacadesRequest::has('column'),function ($query){
            $query->orderBy(FacadesRequest::input('column'),FacadesRequest::input('direction'));
        })
        ->paginate($perPage)
        ->withQueryString();
        return Inertia::render('Category/CategoryScreen', [
            'categories' => $categories, 'filters' => FacadesRequest::only(['search','per_pages'])
        ]);
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
        
        //throw ValidationException::withMessages(['name' => 'This Category Exists !']);
    
        $data['display'] = 0;
        Category::create($data);
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
            'name' => 'required|string|max:60|unique:categories,name',
        ]);
        Category::where('id', $id)->update(['name' => $data["name"], 'display' => $data["display"]]);
    }

    public function update_display(Request $request)
    { 
        $id = $request["checkbox"];
        $display = Category::where('id', $id)->first();
        if($display->display == 1){
            Category::where('id', $id)->update(['display' => 0]);
        }
        else{
            Category::where('id', $id)->update(['display' => 1]);
        }
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
    }
}
