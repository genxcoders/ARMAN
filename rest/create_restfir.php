<?php require_once( '../couch/cms.php'); ?>
<?php require_once( 'loginClass.php'); ?>
<?php
  $baseurl =
  $res = json_decode(file_get_contents("php://input"));
  $db = mysqli_connect('localhost','root','','arman');
  $verify_sql = "select * from couch_users where hashToken='".$res->hashToken."'";
  $verify_res = mysqli_query($db,$verify_sql);
  $verify_resobj = mysqli_fetch_object($verify_res);
  $verify_count = mysqli_num_rows($verify_res);
  
  if($verify_count > 0){
    $CTX->set('userid', $verify_resobj->id, 'global');
    $CTX->set('hasToken', $res->hashToken, 'global');
    $baseurl = "http://localhost/GenXCoders-CTO/ARMAN/rest/input/receiveFIR.php";
    $post_data ="&k_page_title=".$res->k_page_title."&fir_date=".$res->fir_date."&fir_time=".$res->fir_time."&fir_train_no=".$res->fir_train_no."&fir_loco_no=".$res->fir_loco_no."&fir_informer_name="."4"."&fir_ohemast=".$res->fir_ohemast."&fir_lati=".$res->fir_lati."&fir_longi=".$res->fir_longi."&fir_desc=".$res->fir_desc;
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

