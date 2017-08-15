<?php

namespace app\Helpers;

use app\Models\User;
use app\Models\Group;
use app\Models\SmsLog;
use app\Models\Contact;
use app\Models\Setting;
use app\Models\Bulletin;
use app\Models\ContactGroup;
use app\Models\SmsTimestamp;
use app\Helpers\CreateMessage;

class SendBulletin 
{
	function fetch_bulletin($sms_from, $sms_body)
	{
        $administrators         = User::where('is_active', '=', '1')->where('is_updated', '=', '1')->where('is_admin', '=', '1')->get();
        $contacts               = Contact::where('is_active', '=', '1')->whereHas('groups', function($q) { $q->where('is_active', '=', '1'); })->get();
        $groups                 = Group::get();
        $sms_type               = 'Auto';
		$sms 					= new CreateMessage;
		$sms_footer             = Setting::pluck('st_footer');
		
        if($sms_body === 'EQ UPDATE') {
            $bulletin           = Bulletin::where('bt_id', '=', '1')->latest('bl_id')->first();
            $message            = "[Earthquake Information]\n\n";
            $message            .= $bulletin['bl_message']."\n\n";
            $message            .= $sms_footer;
            $this->inbox_message($sms_from, $message, 1);
            $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
        }
        elseif($sms_body === 'WB UPDATE') {
            $bulletin           = Bulletin::where('bt_id', '=', '3')->latest('bl_id')->first();
            $message            = "[Weather Update]\n\n";
            $message            .= $bulletin['bl_message']."\n\n";
            $message            .= $sms_footer;
            $this->inbox_message($sms_from, $message, 1);
            $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
        }
        elseif($sms_body === 'VOL UPDATE') {
            $bulletin           = Bulletin::where('bt_id', '=', '2')->latest('bl_id')->first();
            $message            = "[Volcano Update]\n\n";
            $message            .= $bulletin['bl_message']."\n\n";
            $message            .= $sms_footer;
            $this->inbox_message($sms_from, $message, 1);
            $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
        }
        elseif($sms_body === 'TC UPDATE') {
            $bulletin           = Bulletin::where('bt_id', '=', '5')->latest('bl_id')->first();
            $message            = "[Tropical Cyclone Update]\n\n";
            $message            .= $bulletin['bl_message']."\n\n";
            $message            .= $sms_footer;
            $this->inbox_message($sms_from, $message, 1);
            $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
        }
        elseif($sms_body === 'GROUPS') {
            $message    = "[Group List]\n\n";
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    foreach($groups as $group) {
                        $message .= $group->g_name.": ".$group->g_id."\n";
                    }
                    $message .= "\n".$sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
                else {
                    $message    = "[System Reply]\n\n";
                    $message    .= "Sorry, the keyword you have entered is invalid. To list all the keywords available. Reply KEYWORDS to this number.\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
            }
        }
        elseif(strpos($sms_body, "MSG BLAST:") !== false) {
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    $msg_body           = substr($sms_body, strpos($sms_body, ":") + 1)."\n\n";
                    if(strlen(trim($msg_body)) == 0) {
                        $message            = "[Message Blast]\n\n";
                        $message            .= "Message blast was not successfully sent because the message was empty.\n\n";
                        $message            .= $sms_footer;
                        $this->inbox_message($sms_from, $message, 1);
                        $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0)); 
                    }
                    else {
                        $message            = "[Message Blast]\n\n";
                        $message            .= substr($sms_body, strpos($sms_body, ":") + 1)."\n\n";
                        $message            .= $sms_footer;
                        foreach($contacts as $contact) {
                            $this->inbox_message($contact->c_number, $message, 1);
                            $sms->send_message($contact->c_number, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));  
                        }
                    }
                }
                else {
                    $message    = "[System Reply]\n\n";
                    $message    .= "Sorry, the keyword you have entered is invalid. To list all the keywords available. Reply KEYWORDS to this number.\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
            }
        }
        elseif(strpos($sms_body, "BULLETIN UPDATE ALL:") !== false) {
            $id                 = substr($sms_body, strpos($sms_body, ":") + 1);
            $bulletin           = Bulletin::find($id);
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    if($bulletin == null) {
                        $message = "[Bulletin Update]\n\n";
                        $message .= "No bulletins found with the ID: ".$id."\n\n";
                        $message .= $sms_footer;
                        $this->inbox_message($sms_from, $message, 1);
                        $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                    }
                    else {
                        $message = "[".$bulletin->bulletin_type->bt_name."]\n\n";
                        $message .= $bulletin->bl_message."\n\n";
                        $message .= $sms_footer;
                        foreach($contacts as $contact) {
                            $this->inbox_message($contact->c_number, $message, 1);
                            $sms->send_message($contact->c_number, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                         }
                    }
                }
                else {
                    $message    = "[System Reply]\n\n";
                    $message    .= "Sorry, the keyword you have entered is invalid. To list all the keywords available. Reply KEYWORDS to this number.\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
            }
        }
        elseif(strpos($sms_body, "BULLETIN UPDATE GROUP:") !== false) {
            $last_string        = substr($sms_body, strpos($sms_body, ":") + 1);
            $bulletin_id        = substr($last_string, 0, strpos($last_string, "."));
            $group_id           = substr($last_string, strpos($last_string, ".") + 1);
            $group_array        = explode(",", substr($last_string, strpos($last_string, ".") + 1));
            $bulletin           = Bulletin::find($bulletin_id);
            $contact_group      = ContactGroup::whereIn('g_id', $group_array)->get();
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    if($bulletin == null) {
                        $message = "[Bulletin Update]\n\n";
                        $message .= "No bulletins found with the ID: ".$bulletin_id."\n\n";
                        $message .= $sms_footer;
                        $this->inbox_message($sms_from, $message, 1);
                        $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                    }
                    else {
                        if(!count($contact_group)) {
                            $message = "[Bulletin Update]\n\n";
                            $message .= "No contacts found with these Group ID's: ".$group_id."\n\n";
                            $message .= "To see the list of Group ID's, reply the keyword GROUPS to this number.\n\n";
                            $message .= $sms_footer;
                            $this->inbox_message($sms_from, $message, 1);
                            $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                        }
                        else {
                            $message    = "[".$bulletin->bulletin_type->bt_name."]\n\n";
                            $message    .= $bulletin->bl_message."\n\n";
                            $message    .= $sms_footer;
                            foreach($contact_group as $cg) {
                                foreach($cg->contacts as $contact) {
                                    $this->inbox_message($contact->c_number, $message, 1);
                                    $sms->send_message($contact->c_number, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                                }
                            }
                        }
                    }
                }
            }
        }
        elseif($sms_body === 'KEYWORDS') {
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    $message    = "[LGUIDS SMS KEYWORDS]\n\n";
                    $message    .= "Type these keywords to get latest updates.\n";
                    $message    .= "EQ UPDATE for latest earthquake update.\n";
                    $message    .= "WB UPDATE for latest weather update.\n\n";
                    $message    .= "[Admin Commands]\n\n";
                    $message    .= "GROUPS to see the list of group ID's.\n";
                    $message    .= "MSG BLAST: {message} where {message} is the actual message you want to disseminate.\n";
                    $message    .= "BULLETIN UPDATE ALL:{id} where ID is the bulletin ID, example: BULLETIN UPDATE ALL:123 - This sends to all ACTIVE contacts/groups.\n";
                    $message    .= "BULLETIN UPDATE GROUP:{bulletin_id}. {group_id} where you can send bulletin to specified groups using their ID's. example: BULLETIN UPDATE GROUP:123. 1,2,3\n";
                    $message    .= "NOTE: The dot and comma is important!\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
                else {
                    $message    = "[LGUIDS SMS KEYWORDS]\n\n";
                    $message    .= "Type these keywords to get latest updates.\n";
                    $message    .= "EQ UPDATE for latest earthquake update.\n";
                    $message    .= "WB UPDATE for latest weather update.\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
            }
        }
        elseif($sms_body === 'SHUTDOWN') {
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    echo shell_exec("shutdown -h +2");
                    $message = "[System Reply]\n\n";
                    $message .= "System will shutdown in a few seconds.\n\n";
                    $message .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
                else {
                    $message    = "[LGUIDS Sms Keywords]\n\n";
                    $message    .= "Type these keywords to get latest updates.\n";
                    $message    .= "EQ UPDATE for latest earthquake update.\n";
                    $message    .= "WB UPDATE for latest weather update.\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
            }
        }
        elseif($sms_body === 'RESTART') {
            foreach($administrators as $admin) {
                if($sms_from == $admin->u_number) {
                    echo shell_exec("reboot -h +2");
                    $message = "[System Reply]\n\n";
                    $message .= "System will restart in a few seconds.\n\n";
                    $message .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
                else {
                    $message    = "[LGUIDS Sms Keywords]\n\n";
                    $message    .= "Type these keywords to get latest updates.\n";
                    $message    .= "EQ UPDATE for latest earthquake update.\n";
                    $message    .= "WB UPDATE for latest weather update.\n\n";
                    $message    .= $sms_footer;
                    $this->inbox_message($sms_from, $message, 1);
                    $sms->send_message($sms_from, $message, $sms_type, $this->inbox_message(NULL, NULL, 0));
                }
            }
        }
	}

	function inbox_message($sl_number = null, $sl_message = null, $status)
	{
		static $id 					= null;
		if($status == 1) {
			$timestamp 				= SmsTimestamp::first();
			$logs 					= new SmsLog;
			$logs->sl_number 		= $sl_number;
			$logs->sl_message 		= $sl_message;
			$logs->sl_status 		= 'QUEUED';
			$logs->sl_timestamp 	= $timestamp->last_msg;
			$logs->is_read 			= 0;
			$logs->save();
			$id 					= $logs->sl_id;
		}
		return $id;
	}
}