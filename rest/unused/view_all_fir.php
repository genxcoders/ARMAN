<?php require_once( '../couch/cms.php'); ?>
<?php require_once( 'loginClass.php'); ?>
<?php
  $res = json_decode(file_get_contents("php://input"));
  $db = mysqli_connect('localhost','root','','arman');
  $verify_sql = "select * from couch_users where hashToken='".$res->hashToken."'";
  $verify_res = mysqli_query($db,$verify_sql);
  $verify_resobj = mysqli_fetch_object($verify_res);
  $verify_count = mysqli_num_rows($verify_res);
  
  if($verify_count > 0){
    $CTX->set('userid',$res->userid, 'global');
    $CTX->set('hasToken', $res->hashToken, 'global');
           $post_data ="&userid=".$res->userid;
           $baseurl ="http://localhost/GenXCoders-CTO/ARMAN/rest/allfirJSON.php";
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

