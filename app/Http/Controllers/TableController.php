<?php

namespace App\Http\Controllers;

use App\Models\Hold;
use App\Models\Posale;
use App\Models\Register;
use App\Models\Sale;
use App\Models\Setting;
use App\Models\Store;
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
            'name' => $request->has('name') ?'required|string|max:150':'',
            'status' =>$request->has('status') ? 'required|phone|max:40':'',
            'time' => 'required|int',
            'checked' => 'required|string|max:50',
        ]);

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


    public function selectTable($register_id, $id)
    {
        $hold = Hold::where(['register_id' => $register_id, 'table_id' => $id])->first();

        if (!$hold) {
            $attributes = array(
                'number' => 1,
                'time' => date("H:i"),
                "table_id" => $id,
                'register_id' => $register_id
            );
            Hold::create($attributes);
        } else {
            Posale::where(['number' => 1, 'register_id' => $register_id, 'table_id' => $id])->update(['status' => 1]);
        }
        if ($id > 0) {
            $table = Table::find($id);
            if ($table->status != 1) {
                $table->status = 1;
                $table->time = date("H:i");
                $table->save();
            }
        } else {
            Setting::update_all(array(
                'set' => array(
                    'time_visit' => date("Y-m-d H:i:s")
                ),
            ));
            Posale::where(['number' => 1, 'register_id' => $register_id, 'table_id' => $id])->update(['time_visit' => date("Y-m-d H:i:s")]);
        }

        return ["selectedTable" => $id];
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

    public function switchTable($register_id)
    {
        Posale::where(['status' => 1, 'register_id' => $register_id])->update([
            'status' => 0
        ]);

        return ["selectedTable" => 0];
    }

    public function addNewTableSale(Request $request, $tableId)
    {
        $date = date("Y-m-d H:i:s");
        $register = Register::find($request['register_id']);
        $store = Store::find($register->store_id);
        $sale = Sale::create($request);

        $posales = Posale::where(['register_id' => $request['register_id'], 'table_id' => $tableId])->get();
        $holds = [];

        if ($tableId == 0) {
        } else {
            $tabb = Table::find($tableId);
        }
        $poss = Posale::where(['table_id' => $tableId])->groupBy('number')->get();

        foreach ($poss as $posss) {
            $hold = Hold::where(['number' => $posss->number, 'register_id' => $request['registerId'], 'table_id' => $tableId])->get();
            array_push($holds, $hold);
        }
        return ([
            'date' => $date,
            'register' => $register,
            'store' => $store,
            'sale' => $sale,
            'table' => $tabb,
            'posales' => $posales,
            'holds' => $holds
        ]);
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
            'name' => $request->has('name') ?'required|string|max:150|unique:tables,name':'',
            'status' => $request->has('status') ?'required|phone|max:40':'',
            'time' => $request->has('time') ?'required|int':'',
            'checked' => $request->has('checked') ?'required|string|max:50':'',
        ]);
        if(count($data)>0)
        Table::where('id', $id)->update([$data]);
    }

    public function exchangeTables(Request $request)
    {
        $table1 = $request['table1'];
        $table2 = $request['table2'];
        if ($table1 != $table2) {
            $result_table1 = Posale::where("table_id", $table1)->get();
            $result_table2 = Posale::where("table_id", $table2)->get();
            if ($result_table2->isEmpty()) {
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
    }

    

    public function CloseTable(Request $request)
   {
      Hold::where(['table_id' => $request['table_id'] , 'register_id' => $request['register_id']])->delete();
      Posale::where(['table_id' => $request['table_id'] , 'register_id' => $request['register_id']])->delete();
              
      if($request['table_id'] != 0){

         $table = Table::find($request['table_id']);
            $table->status = 0;
            $table->time = '';
            $table->save();
      }
   }

}
