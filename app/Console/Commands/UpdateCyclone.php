<?php

namespace app\Console\Commands;

use app\Models\User;
use app\Models\Setting;
use app\Models\Bulletin;
use app\Helpers\CreateMessage;
use Illuminate\Console\Command;

class UpdateCyclone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cyclone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch tropical cyclone update to PAGASA website.';

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
        $url                = Setting::pluck('st_address').'/updates/cyclone.txt';
        $message            = file_get_contents($url);

        if(!empty($message)) {
            
            $latest_bulletin    = Bulletin::where('bl_message', '=', $message)->where('bt_id', '=', '5')->latest('bl_id')->get();

            if($latest_bulletin->count()) {
                echo "Same bulletin. Not saving to database. \n";
            }
            else {
                $bulletin               = new Bulletin;
                $bulletin->bl_message   = $message;
                $bulletin->bt_id        = 5;
                $bulletin->save();

                $final_message          = 'ID: '.$bulletin->bl_id."\n\n";
                $final_message          .= '[TROPICAL CYCLONE UPDATE]'."\n\n";
                $final_message          .= $message."\n\n";
                $final_message          .= Setting::pluck('st_footer');

                $users                  = User::where('is_updated', '=', '1')->where('is_active', '=', '1')->get();

                if(!count($users)) {
                    echo "No user(s) is active.";
                }
                else {
                    foreach($users as $user) {
                        $msg    = new CreateMessage;
                        $msg->send_message($user->u_number, $final_message, 'Update', $bulletin->bl_id);
                    }
                }
            }
        }
        else {
            echo "No updates found.";
        }
    }
}