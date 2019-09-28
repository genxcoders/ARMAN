<?php require_once( '../../couch/cms.php' ); ?>
<?php require_once( '../loginClass.php' ); ?>
<?php

		$res = json_decode(file_get_contents("php://input"));
		echo json_encode($res);	
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
            print_r($response);
?>
<?php COUCH::invoke(); ?>