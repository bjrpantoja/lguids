<?php

namespace app\Console\Commands;

use app\Models\SmsLog;
use app\Models\Bulletin;
use Illuminate\Console\Command;

class MessageFailed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:failed {sms_type?} {bulletin_id?} {recipient_id?}';

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
        if($this->argument('sms_type') == 'Manual') {
            $bulletin   = Bulletin::find($this->argument('bulletin_id'));
            $bulletin->bulletin_recipients()->attach($this->argument('recipient_id'), array('blr_status' => 'FAILED'));
        }
        elseif($this->argument('sms_type') == 'Inbox') {
            $sms                = SmsLog::find($this->argument('bulletin_id'));
            $sms->sl_status     = 'FAILED';
            $sms->sl_timestamp  = strtotime(date('Y-m-d H:i:s'));
            $sms->update();
        }
        elseif($this->argument('sms_type') == 'Auto') {
            $sms                = SmsLog::find($this->argument('bulletin_id'));
            $sms->sl_status     = 'FAILED';
            $sms->sl_timestamp  = strtotime(date('Y-m-d H:i:s'));
            $sms->update();
        }
    }
}
