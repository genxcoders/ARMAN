<?php
require_once( '../couch/auth/auth.php' );
require_once( '../couch/auth/user.php' );
//require_once( '../couch/auth/PasswordHash.php' );
class loginClass{

	
	function get_users_id($params,$params2){
		global $DB;
		$userid='0';///No password Delivered,
		if($params2!=''){
			$user = new KUser( $params );
			$userid=$user->id;
		}
		return $userid;
	}	
		//////////////////////////////////////////////	
	function get_users_info($rtty,$sysPwd,$myPwd,$fcmid){
		global $DB;
		/////////////////////////////////////////////
		
		if($fcmid==''){
			$hast='2';///No FCM ID
			return $hast;
			exit;
		}
		if($sysPwd!=$myPwd){
			$hast='3';///Wrong Password Entered
			return $hast;
			exit;
		}
		
		/////////////////////////////////////////////
		if($sysPwd==$myPwd){
			$n='20';
			$hast=bin2hex($this->getName($n));
			/////////////////////////////////////////////
			$sql ="UPDATE ".K_TBL_USERS." SET  
			hashToken ='".$hast."',
			fcmId ='".$fcmid."'
			WHERE 
			id='".$DB->sanitize( $rtty )."'";

			if($DB->_query( $sql )){
				$sql_pgid = $DB->_query("SELECT cp.id FROM `couch_pages` cp INNER JOIN `couch_users` cu ON cu.id='".$DB->sanitize( $rtty )."' and cp.page_name = cu.name WHERE template_id = 3");

				$dd = "SELECT cp.id as page_id FROM `couch_pages` cp INNER JOIN `couch_users` cu ON cu.id='".$DB->sanitize( $rtty )."' and cp.page_name = cu.name WHERE template_id = 3";

				$sql_deviceid ="Update couch_data_text set value = '".$fcmid."' where page_id = '".$sql_pgid['page_id']."' and field_id = 13";

				$res_deviceid = $DB->_query($sql_deviceid);
					//return $hast."_".$dd;
					return $hast;
			}
		}else{
			$hast='4';///Unknown Error
			return $hast;
		}
	}	

		//////////////////////////////////////////////	
	function getName($n) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 
	  
		for ($i = 0; $i < $n; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 
	  
		return $randomString; 
	}

}
?>


