<?php

namespace App\Http\Controllers;

use App\Models\CategoryExpence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class CategoryExpenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = FacadesRequest::input('per_pages');
        if ($perPage == null) {
            $perPage = 5;
        }
        if (FacadesRequest::input('checkbox') != null) {
            $perPage = 5;
        }
        $categories = CategoryExpence::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when(FacadesRequest::has('column'), function ($query) {
                $query->orderBy(FacadesRequest::input('column'), FacadesRequest::input('direction'));
            })
            ->paginate($perPage)
            ->withQueryString();
        return Inertia::render('Category/AllCategoryScreen', [
            'page_name' => 'categoryexpences', 'categories' => $categories, 'filters' => FacadesRequest::only(['search', 'per_pages'])
        ]);
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
            'name' => 'required|string|max:60|unique:category_expences,name',
        ]);
        CategoryExpence::create($data);
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
            'name' => $request->has('name') ?'required|string|max:60|unique:categorie_expences,name':'',
        ]);
        if(count($data)>0)
        CategoryExpence::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryExpence::destroy((int)$id);
    }
}
