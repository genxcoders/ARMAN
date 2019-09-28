<?php require_once( 'couch/cms.php' ); ?>
<cms:template title="Send Message" order='1' >
	<cms:editable name='token' label='Token' type='text' order='1'/>
</cms:template>
	<?php
		define('SERVER_API_KEY', 'AIzaSyCaB-OqZetsQOS6H_zYkETrUU_KnPy15Ys');

		$tokens = ['ewAXQNZ31M4:APA91bHlaAybE0iKLprm89ra7XexPBmJ3Z3xppb_B7g37W6C5jR6BTAmIMj3m0rz-mDiEndXXIX8L1K6uLqskul0fbqu-jclW7ELBMVs7U3GbutK9ZwC91a7jSe94wjiWml6duCHlanl'];

		$header = [
			'Authorization:Key=' . SERVER_API_KEY,
			'Content-Type: Application/json'
		];

		$msg = [
			'title' => 'Testing Notification',
			'body' => 'Testing Notification from localhost',
			'icon' => 'img/icon.png',
			'image' => 'img/d.png',
		];

		$payload = [
			'registration_ids' => $tokens, 
			'data'             => $mgs
		];


		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($payload),
			CURLOPT_HTTPHEADER => $header
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	?>
<?php COUCH::invoke(); ?>