<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Providers\smsGateway;
use App\Http\Controller\IncidentController;

class SendMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $incidentcontroller;

    public function __construct($incidentcontroller)
    {
        $this->incidentcontroller = $incidentcontroller;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->incidentcontroller["numbers"] as $number){
            $smsGateway = new SmsGateway('brgypayatassystem@gmail.com', 'payatasquezoncity');
            $numbertosend = $number;
            if($this->incidentcontroller['stat']=='Action Done'){
                $message = "There is an incident - ".$this->incidentcontroller["incident"]."  happened near your area at ".$this->incidentcontroller['time'].". Keep Safe  -Barangay Payatas(Trial) *This message is intended for Barangay Payatas Residents";
            }
            else{
                $message = "There is an incident - ".$this->incidentcontroller["incident"]."  happening near your area at ".$this->incidentcontroller['time'].". Keep Safe  -Barangay Payatas(Trial) *This message is intended for Barangay Payatas Residents";
            }
            $deviceID = 56806;

            $result = $smsGateway->sendMessageToNumber($numbertosend, $message, $deviceID);
        }
    }
}
