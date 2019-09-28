<?php 
require_once( '../couch/cms.php' );
require_once( '../loginClass.php' ); 
/*
---------------------------------------------
========== DB UPDATE CODE ===========
ALTER TABLE `couch_users`  ADD `deviceId` VARCHAR(255) NULL DEFAULT NULL  AFTER `hashToken`,  ADD `fcmId` VARCHAR(255) NULL DEFAULT NULL  AFTER `deviceId`;
==========RETURN PARAMETER DETAILS===========
0===No password Delivered
-1==Username Not Exist
1===No Device ID
2===No FCM ID
3===Wrong Password Entered
4===Some Unknown Error
---------------------------------------------
*/

?>

<cms:php>
    // invoke the function from within Couch ..
    $functions = new loginClass();
	$result = $functions->get_users_id(@$_REQUEST['username'],
	@$_REQUEST['password']);
    // set result in global context for use by Couch tags
    global $CTX;
    $CTX->set( 'userid', $result, 'global' );
</cms:php>
<cms:no_cache/>
<cms:pages masterpage=k_user_template page_id=userid show_future_entries='1' custom_field="extended_user_id=<cms:show userid />" >
	<cms:php>
		$functions = new loginClass();
		$sysPwd ='<cms:show ipt_psw />';
		$varri = $functions->get_users_info(<cms:show userid />,$sysPwd,@$_REQUEST['password'],@$_REQUEST ['fcmid']);
		global $CTX;
		$CTX->set('hasToken', $varri, 'global' );
	</cms:php>
</cms:pages>

<cms:template title='LoginAPIJson' />
<cms:content_type 'application/json'/>
{
	"hashID":
	[
        {
            "HashT": "<cms:show hasToken />"
		}
	]
}	
<?php COUCH::invoke(); ?>