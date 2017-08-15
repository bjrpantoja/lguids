#!/usr/bin/php
<?php 
$sms_type 			= $argv[1];
$sms_file 			= $argv[2];
$sms_file_name 		= basename($argv[2]);

$sms_file_content 	= file_get_contents($sms_file);
$i = strpos($sms_file_content, "\n\n");
$sms_headers_part 	= substr($sms_file_content, 0, $i);
$sms_message_body 	= substr($sms_file_content, $i + 2);
$sms_header_lines 	= explode("\n", $sms_headers_part);
$sms_headers = array();

foreach($sms_header_lines as $header) {
	$i = strpos($header, ":");
	if($i !== false) {
		$sms_headers[substr($header, 0, $i)] = substr($header, $i + 2);
	}
}

if($sms_type == "SENT") {
	echo shell_exec('cd /var/web/lguids-v4; php artisan sms:sent '.$sms_headers['Type'].' '.$sms_headers['bId'].' '.$sms_headers['rId']);
}
elseif($sms_type == "FAILED") {
	echo shell_exec('cd /var/web/lguids-v4; php artisan sms:failed '.$sms_headers['Type'].' '.$sms_headers['bId'].' '.$sms_headers['rId']);
}
elseif($sms_type == "RECEIVED") {
	echo shell_exec('cd /var/web/lguids-v4; php artisan sms:received '.$sms_headers['From'].' '.escapeshellarg($sms_message_body));
}

?>
