<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAACJ92mSc:APA91bEcyKjAgp8VSk_GUQBx2DoJm7xyJrttSUON2y-pYf6xM7BmQ9E8VzvQqZLStw8uRIV8OQT0SLxnxXMc9XaTWiKSicjTOAcOoS8IFw0TZpluJFaqHn2jwUbhR5C4t4iCFavrHGEv' );
$registrationIds = array( "fgOoIi2NSEE:APA91bEh_wFskvUyrAt-e3Zz8N279m33ynaJ3hjka_30nNSyADh3nroN15o9ejFmOrkcr3KLqGl-yRvyDLO6uX1skb9tpVbUGINFXFQwUxocqYBTsEY-48JM-qMrixZ_SCptXr_zrM_0","dkMqsjBpmsU:APA91bFX5rahsjNRT3BADNzSn47rUNCr9nhEPQLx7RVXbLFM247j1lTNyog_CGTMSrZbyBYwXTANYARj2ygaw5LNidwaCsHY-ka-qQcMonTySaXd8slmrpjvEQbclynosBiqKtMZjgjW" );
// prep the bundle
$msg = array
(
    'message'   => 'here is a message. message',
    'title'     => 'This is a title. title',
    'subtitle'  => 'This is a subtitle. subtitle',
    'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'   => 1,
    'sound'     => 1,
    'largeIcon' => 'large_icon',
    'smallIcon' => 'small_icon'
);
$fields = array
(
    'registration_ids'  => $registrationIds,
    'data'          => $msg
);
 
$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;

?>