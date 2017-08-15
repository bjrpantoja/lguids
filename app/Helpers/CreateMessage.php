<?php

namespace app\Helpers;

class CreateMessage 
{
	function send_message($sms_number, $sms_message, $sms_type = NULL, $bulletin_id = NULL, $recipient_id = NULL)
	{
		$folder 	= '/var/spool/sms/outgoing/';
		$filename 	= tempnam("","");
		$file 		= fopen($filename,"w");
		fwrite($file, "To: ".$sms_number."\n");
		fwrite($file, "Type: ".$sms_type."\n");
		fwrite($file, "bId: ".$bulletin_id."\n");
		fwrite($file, "rId: ".$recipient_id."\n\n");
		fwrite($file, $sms_message."\n");
		fclose($file);
		copy($filename, $folder.basename($filename));
		unlink($filename);
	}
}