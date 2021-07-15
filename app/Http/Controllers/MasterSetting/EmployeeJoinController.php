<?php

namespace App\Http\Controllers\MasterSetting;

use App\Jobs\SendMailToClientJob;
use App\Models\MasterSetting\Maintenace;
use App\Models\MasterSetting\MaintenaceBillLedger;
use App\Models\MasterSetting\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmployeeJoinController extends Controller
{
    public function employeeidcard()
    {
        return view('MasterSetting.join_employee.employeeidcard');
    }

    public function employeeidcardlistdata(Request $request)
    {
        $data = DB::select("
            select s.id, CONCAT(c.client_name) AS customer, s.to_information, s.from_information,
                   s.software_name, s.valid, s.send_to, s.amount
                from
            service_confiq s
                join
            client_information c on s.client_information_id = c.id
                and s.valid = 1
                where s.valid = 1
                and s.id not in (
                    select service_confiq_id
                        from
                    maintenace_bill
                        where
                            year_id = $request->year_id
                        and
                            month_id = $request->month_id
                    )
        ");

        return response()->json(['data' => $data]);
    }

    public function submitemployeeidcard(Request $request)
    {
        if (empty($request->ids)) {
            return back()->with('alert-danger', 'Please Check This List,Some Employees has no finger code!');
        }

        $sendMailToClients = DB::table('service_confiq as a')
            ->leftJoin('client_information as c', 'c.id', '=', 'a.client_information_id')
            ->select('c.address', 'c.client_name', 'c.client_code', 'c.contact_person', 'c.email', 'c.created_at',
                'a.id', 'a.to_information', 'a.from_information',
                'a.software_name', 'a.send_to', 'a.amount'
            )
            ->whereIn('a.id', $request->ids)
            ->get();

        SendMailToClientJob::dispatch($sendMailToClients);

        $this->fillOtherTable($request, $sendMailToClients);

        return response()->json([
            'success'   => true,
            'messages'  => 'Successfully update!'
        ]);
    }

    protected function fillOtherTable($request, $sendMailToClients)
    {
        foreach ($sendMailToClients as $service) {

            $bill_no = Service::generate_tr_number("maintenace_bill", "bill_no");

            DB::transaction(function () use ($service, $request, $bill_no) {
                $maintenance = new Maintenace;
                $maintenance->service_confiq_id = $service->id;
                $maintenance->year_id = $request->year;
                $maintenance->month_id = $request->month;
                $maintenance->bill_no = 'IBS-'.$bill_no;
                $maintenance->amount = $service->amount;
                $maintenance->send_to = $service->send_to;
                $maintenance->save();

                $data_in = new MaintenaceBillLedger;
                $data_in->maintenace_bill_id = $maintenance->id;
                $data_in->payableamount = $service->amount;
                $data_in->receiving_amount = 0;
                $data_in->save();
            });
        }
    }
}
