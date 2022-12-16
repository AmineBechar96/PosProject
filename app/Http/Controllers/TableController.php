<?php

namespace App\Http\Controllers;

use App\Models\Posale;
use App\Models\Table;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;

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
            'name' => 'required|string|max:150',
            'status' => 'required|phone|max:40',
            'time' => 'required|int',
            'checked' => 'required|string|max:50',
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
        return Response(['tables' => $tables, 'zones', $zones]);
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
        return Response(['table' => $table, 'zones' => $zones]);
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
            'name' => 'required|string|max:150',
            'status' => 'required|phone|max:40',
            'time' => 'required|int',
            'checked' => 'required|string|max:50',
        ]);
        Table::where('id', $id)->update([$data]);
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
        Zone::destroy($id);
        return response(['success' => true]);
    }

    public function exchangeTables(Request $request)
    {
        $table1 = $request['table1'];
        $table2 = $request['table2'];
        if ($table1 != $table2) {
            $result_table1 = Posale::where("table_id", $table1)->get();
            $result_table2 = Posale::where("table_id", $table2)->get();
            if ($result_table2->isEmpty()) {
                print('aaaaaaaaaaaa');
                Posale::where('table_id', $table1)->update([
                    'table_id' => $table2,
                    'status' => 1
                ]);
            } else {
                foreach ($result_table1 as $tab1) {
                    $option_posales1 = $tab1->options->makeHidden(['pivot']);
                    foreach ($result_table2 as $tab2) {
                        $option_posales2 = $tab2->options->makeHidden(['pivot']);
                        $differentItems = $option_posales1->diff($option_posales2);
                        $differentItems2 = $option_posales2->diff($option_posales1);
                        if (($differentItems->isEmpty() && $differentItems2->isEmpty()) && ($tab2->product_id == $tab1->product_id)) {
                            $qt1 = $tab1->quantity;
                            $qt2 = $tab2->quantity;
                            $qt3 = $qt1 + $qt2;
                            Posale::where('id', $tab2->id)->update(
                                ['quantity' => $qt3]
                            );
                            Posale::where('id', $tab1->id)->delete();
                        } else {
                            Posale::where('id', $tab1->id)->update(
                                ['table_id' => $table2, 'status' => 1]
                            );
                        }
                    }
                }
            }
        }
        return response(['success' => true]);
    }
}
