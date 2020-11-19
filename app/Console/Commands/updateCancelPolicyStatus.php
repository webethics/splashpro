<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class updateCancelPolicyStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Cancelpolicy:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cancel policy status if new user register with our website more than 15 days.';

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
        $users = User::where('show_cancellation_status',0)->get();
        if(!is_null($users) && count($users)>0){
            foreach ($users as $key=>$user){
                $date = Carbon::parse($user['created_at']);
                $now = Carbon::now();

                $diff = $date->diffInDays($now);
                if($diff > 15){
                    //hide cancellation button from frontend
                    $updateUserInfo = $this->updateUser($user);
                }
            }
        }
       
    }


    /*update User Table*/
    public function updateUser($data){
        $user = User::find($data['id']);

        if ($user) {
            $user->update([
                'show_cancellation_status' => 1
            ]);
        }
    }
}
