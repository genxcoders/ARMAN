<?php require_once( '../../couch/cms.php'); ?>
<?php require_once( '../loginClass.php'); ?>
<?php
	
	$res = json_decode(file_get_contents("php://input"));
	$verify_sql = "select * from couch_users where id={$data->user_id} and hashToken='".$data->hashToken."'";
	$verify_res = mysqli_query($db,$verify_sql);
	$verify_count = mysqli_num_rows($verify_res);
	if($verify_count >0){
		$CTX->set('userid', $data->user_id, 'global');
		$CTX->set('hasToken', $data->hashToken, 'global');
		echo json_encode(array("status" => "Successfully Authenticated"));
	}else{
	echo json_encode(array("status" => "you are not Authenticated"));
	}

		
		/*echo json_encode($res);	
			$fname = $_POST["fname"];
			$email = $_POST["email"];
			$pass  = $_POST["pass"];
			$dob   = $_POST["dob"];
			$gend  = $_POST["gend"];
			$hobbies = $_POST["hobbies"];
			$baseurl = "http://localhost/GenXCoders-CTO/DMA-Design/";
			$path    ="rest/input/receiveFIR.php"; 
            
            $post_data ="&fname=".$fname."&email=".$email."&pass=".$pass."&dob=".$dob."&gend=".$gend."&hobbies=".$hobbies." "; 
            $post = curl_init();  
            curl_setopt($post, CURLOPT_URL,$baseurl.$path); 
            curl_setopt($post, CURLOPT_POST,TRUE);   
            curl_setopt($post, CURLOPT_POSTFIELDS, $post_data); 
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE); 
            $response = curl_exec($post); 
            curl_close($post);
            print_r($response);*/
?>