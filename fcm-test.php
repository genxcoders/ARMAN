<?php require_once( 'couch/cms.php' ); ?>
<cms:template title="FCM TEST" />
<?php
	function sendFCM($mess,$id) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array (
				
		        'to' => $id,
		        'notification' => array (
		                "body" => $mess,
		                "title" => "Title",
		                "icon" => "myicon"
		        )
		    	
		);
		$fields = json_encode ( $fields );
		$headers = array (
		        'Authorization: key=' . "AAAACJ92mSc:APA91bEcyKjAgp8VSk_GUQBx2DoJm7xyJrttSUON2y-pYf6xM7BmQ9E8VzvQqZLStw8uRIV8OQT0SLxnxXMc9XaTWiKSicjTOAcOoS8IFw0TZpluJFaqHn2jwUbhR5C4t4iCFavrHGEv",
		        'Content-Type: application/json'
		);

		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

		$result = curl_exec ( $ch );
		curl_close ( $ch );
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<button id="mybtn" class="button" type="submit">
		SEND FCM
	</button>
	<script
  src="https://code.jquery.com/jquery-1.12.4.js"
  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		$('#mybtn').click(function() {

		$.ajax({
			type: "POST",
			url: "fcm-test.php",
			data: { name: "John" }
			}).done(function( msg ) {
				alert( "Data sent: " + msg );
			});    

	    });
	</script>
</body>
</html>
<?php COUCH::invoke(); ?>