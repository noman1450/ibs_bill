<?php

namespace App\Http\Controllers\Account\MasterSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


use Validator;
use Exception;

class ChartOfAccountGroupController extends Controller
{
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
        // var_dump($request);
        var_dump($request->name);
        $id = DB::table('users')->insertGetId(
            [
                'name' => $request->name,
                'nett_debit_credit_balance' => $request->nett_debit_credit_balance,
                'use_calculation_taxes_discount ' => $request->use_calculation_taxes_discount,
                'group_behaves_sub_ledger' => $request->group_behaves_sub_ledger,
                'nature_of_group' => $request->group_nature,
                'group_status' => $request->group_status,
                'valid' => 1,
                'acc_chart_of_account_groups_id' => $request->group_nature,
                'gross_profit' => 1,
                'company_infos_id' => 1
            ]
        );
        echo json_encode($id);
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

    public function getGroupList(Request $request){

        $searchTerm = $request->searchTerm; //$this->input->post('searchTerm',true);
        // DB::enableQueryLog();
        $group = DB::table('acc_chart_of_account_groups as ag')
                    ->where('ag.valid', '=', 1)
                    ->where('ag.name','like','%'.$searchTerm.'%')
                    ->select('ag.id','ag.name')
                    ->orderBy('ag.name','ASC')
                    ->get();

        // dd(DB::getQueryLog());

        $data = array();
        foreach ($group as $key => $value) {
            $data[] = array(
                "id"=>$value->id,
                "text"=>$value->name
            );
        }
        echo json_encode($data);
    }
}
