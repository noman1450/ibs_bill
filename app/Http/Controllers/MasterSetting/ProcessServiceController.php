<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProcessServiceController extends Controller
{
    public function index()
    {
        return view('MasterSetting.process_view.index');
    }

    public function getData(Request $request)
    {
        // $month_id = implode(',', $request->month_id);

        $data = DB::select("
            select s.id, CONCAT(c.client_name) AS customer, s.to_information, s.from_information,
                   s.software_name, s.valid, s.send_to, s.amount
                from
            service_confiq s
                join
            client_information c on s.client_information_id = c.id
        ");

        return response()->json(['data' => $data]);
    }
}
