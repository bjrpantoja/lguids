<?php

namespace app\Console\Commands;

use app\Models\User;
use app\Models\SmsLog;
use app\Models\Setting;
use app\Models\Bulletin;
use app\Helpers\SendBulletin;
use app\Helpers\CreateMessage;
use Illuminate\Console\Command;

class MessageReceived extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:received {sms_from?} {message_body?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        $handa_users            = User::where('is_active', '=', '1')->where('is_updated', '=', '1')->where('is_admin', '=', '1')->get();
        $sms                    = new CreateMessage;
        $sms_from               = $this->argument('sms_from');
        $sms_body               = $this->argument('message_body');
        $sms_type               = 'Auto';
        $sending_type           = 'RECEIVED';

        if(substr($sms_from, 0, 3) == '639') {
            $logs               = new SmsLog;
            $logs->sl_number    = $sms_from;
            $logs->sl_message   = $sms_body;
            $logs->sl_status    = $sending_type;
            $logs->sl_timestamp = strtotime(date('Y-m-d H:i:s'));
            $logs->save();
        }
        elseif(substr($sms_from, 0, 2) == '09') {
            $logs               = new SmsLog;
            $logs->sl_number    = "63".substr($sms_from, 1);
            $logs->sl_message   = $sms_body;
            $logs->sl_status    = $sending_type;
            $logs->sl_timestamp = strtotime(date('Y-m-d H:i:s'));
            $logs->save();
            $sms_from           = "63".substr($sms_from, 1);
        }

        $bulletin               = new SendBulletin;
        $bulletin->fetch_bulletin($sms_from, $sms_body);
    }
}