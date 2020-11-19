<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TempUpgradeRequest;
use Carbon\Carbon;

class updateReqUpgradePlanStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpgradePlanRequest:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check upgrade plan request, if user not paid and his request expired date grether than today then cancel his request';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $upgradeRequests = TempUpgradeRequest::where('status',0)->whereDate('request_expired', '<', Carbon::now())->get();
        if(!is_null($upgradeRequests) && count($upgradeRequests)>0){
            foreach ($upgradeRequests as $key=>$request){
                //Cancel upgrade request
                $updateUpgradeRequest = $this->updateRequest($request);
            }
        }
    }

    /*update User Table*/
    public function updateRequest($data){
        $tempRequest = TempUpgradeRequest::find($data['id']);

        if ($tempRequest) {
            $tempRequest->update([
                'status' => 2 /*cancel status*/
            ]);
        }
    }
}
