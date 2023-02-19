<?php

namespace App\Http\Controllers;

use App\Models\CategoryExpence;
use App\Models\Expence;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class ExpenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryExpence::all();
        $stores = Store::all();
        $perPage = FacadesRequest::input('per_pages');
        if ($perPage == null) {
            $perPage = 5;
        }
        if (FacadesRequest::input('checkbox') != null) {
            $perPage = 5;
        }
        $expences = Expence::query()
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('reference', 'like', "%{$search}%");
            })
            ->when(FacadesRequest::has('column'), function ($query) {
                $query->orderBy(FacadesRequest::input('column'), FacadesRequest::input('direction'));
            })
            ->join('category_expences', 'category_expences.id', '=', 'expences.category_id')
            ->join('users', 'users.id', '=', 'expences.created_by')
            ->join('stores', 'stores.id', '=', 'expences.store_id')
            ->select('expences.*', 'users.username', 'category_expences.name', 'stores.name as name2')
            ->paginate($perPage)
            ->withQueryString();
        return Inertia::render('ExpenceScreen', [
            'expences' => $expences,'categories' => $categories, 'stores' => $stores, 'page_name' => 'expenses', 'filters' => FacadesRequest::only(['search', 'per_pages'])
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
            'date' => 'required|date',
            'reference' => 'required|string|max:150',
            'note' => 'required|min:3|max:1000',
            'amount' => 'required|numeric|between:0,999999.99',
            'store_id' => 'required',
            'category_id' => 'required',
        ]);
        $data["created_by"] = 12;
        Expence::create($data);
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
        return Response(['storeName' => $storeName, 'stores' => $stores, 'categories' => $categories, 'expence' => $expence]);
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
            'date' => 'required|date',
            'reference' => 'required|string|max:150',
            'note' => 'required|text',
            'amount' => 'required|float|max:60',
            'attachment' => 'string|max:200',
        ]);
        Expence::where('id', $id)->update([$data]);
        return response(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expence::destroy($id);
    }
}
