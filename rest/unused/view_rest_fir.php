<?php require_once( '../couch/cms.php'); ?>
<?php require_once( 'loginClass.php'); ?>
<?php
	$baseurl =
	$res = json_decode(file_get_contents("php://input"));
	$db = mysqli_connect('localhost','root','','dmadeliver');
	$verify_sql = "select * from couch_users where hashToken='".$res->hashToken."'";
	$verify_res = mysqli_query($db,$verify_sql);
	$verify_resobj = mysqli_fetch_object($verify_res);
	$verify_count = mysqli_num_rows($verify_res);
	
	if($verify_count > 0){
		$CTX->set('userid', $verify_resobj->id, 'global');
		$CTX->set('hasToken', $res->hashToken, 'global');
		$baseurl = "http://localhost/GenXCoders-CTO/DMA-Design/rest/input/receiveFIR.php";
		$post_data ="&k_page_title=".$res->k_page_title."&ipt_date=".$res->ipt_date."&ipt_time=".$res->ipt_time."&ipt_train_no=".$res->ipt_train_no."&ipt_loco_no=".$res->ipt_loco_no."&ipt_informer_no=".$res->ipt_informer_no."&ipt_ohemast=".$res->ipt_ohemast."&ipt_lati=".$res->ipt_lati."&ipt_longi=".$res->ipt_longi."&ipt_desc=".$res->ipt_desc."&ipt_rad_status=".$res->ipt_rad_status;
            $post = curl_init();  
            curl_setopt($post, CURLOPT_URL,$baseurl); 
            curl_setopt($post, CURLOPT_POST,TRUE);   
            curl_setopt($post, CURLOPT_POSTFIELDS, $post_data); 
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE); 
            $response = curl_exec($post); 
            curl_close($post);
            print_r($response);
	}else{
	echo json_encode(array("status" => "you are not Authenticated"));
	}
?>




