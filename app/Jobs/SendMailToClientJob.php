<?php

namespace App\Jobs;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\MasterSetting\Service;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Riskihajar\Terbilang\Facades\Terbilang;

class SendMailToClientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sendMailToClients;

    public function __construct($sendMailToClients)
    {
        $this->sendMailToClients = $sendMailToClients;
    }

    public function handle()
    {
        foreach($this->sendMailToClients as $service) {
            $data = $this->getDta($service);

            $pdf = PDF::loadView('mails.pdf', $data);

            Mail::send('mails.mail', $data, function($message) use ($data, $pdf) {
                $message->to($data['emailsinfo'], $data["email"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        }
    }

    protected function getDta($service): array
    {
        $word = Terbilang::make($service->amount);
        $emailsInfo = $service->to_information;
        $emails = explode(',',$emailsInfo);

        $bill_no = Service::generate_tr_number("maintenace_bill", "bill_no");

        $dt = date('d M Y', strtotime($service->created_at));

        $data["name"] = 'BD accounts';
        $data["subject"] = "Maintenance charge for $service->software_name";
        $data["to_information"] = $service->to_information;
        $data["email"] = $service->from_information;
        $data["amount"] = $service->amount;
        $data["softwarename"] = 'Maintenance charge for '.$service->software_name;
        $data["address"] = $service->address;
        $data["client_name"] = $service->client_name;
        $data["client_code"] = 'IBS-'.$bill_no;
        $data["contact_person"] = $service->contact_person;
        $data["client_email"] = $service->email;
        $data["send_to"] = $service->send_to;
        $data["created_at"] = $dt;
        $data["word"] = $word;
        $data["emailsinfo"] = $emails;

        return $data;
    }
}
