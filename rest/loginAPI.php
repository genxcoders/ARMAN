<?php 
require_once( '../couch/cms.php' );
require_once( 'loginClass.php' ); 
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
<cms:template title="Login API" parent="_security_" />
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
    <cms:set user="<cms:show userid />" scope='global' />
	<cms:php>
		$functions = new loginClass();
		$sysPwd ='<cms:show ipt_psw />';
		$varri = $functions->get_users_info(<cms:show userid />,$sysPwd,@$_REQUEST['password'],@$_REQUEST ['fcmid']);
		global $CTX;
		$CTX->set('hasToken', $varri, 'global' );
        $CTX->set('fcmid', $fcmvarri, 'global' );
	</cms:php>
    <cms:ignore>
    <cms:db_persist 
        _masterpage="users/index.php"
        _mode='edit'
        _page_id='<cms:show userid />'
        _invalidate_cache='0'
        _auto_title='0'
        ipt_emp_registration_ids="<cms:php>echo $fcmvarri;</cms:php>"
    />
    </cms:ignore>
</cms:pages>

<cms:content_type 'application/json'/>
{
	"hashID":
	[
        {
            "HashT": "<cms:show hasToken />",
            <cms:if hasToken eq '0'>
                "message":"Error: Password Required"
            <cms:else_if hasToken eq '2' />
                "message":"Error: FCM ID Required"
            <cms:else_if hasToken eq '3' />
                "message":"Error: Incorrect Password"
            <cms:else_if hasToken eq '4' />
                "message":"Please try again"
            <cms:else />
                "userid":"<cms:show user />",
                "user":
                {
                    <cms:pages masterpage=k_user_template show_future_entries='1' custom_field="extended_user_id=<cms:show user />" >
        				"userdp":"<cms:addslashes><cms:show_securefile 'ipt_emp_photo'><cms:if file_is_image ><cms:securefile_link file_id /></cms:if></cms:show_securefile></cms:addslashes>",
        				"email":"<cms:addslashes><cms:show extended_user_email /></cms:addslashes>",
        				"fname":"<cms:addslashes><cms:show ipt_emp_fname /></cms:addslashes>",
        				"lname":"<cms:addslashes><cms:show ipt_emp_lname /></cms:addslashes>",
        				"designation":"<cms:addslashes><cms:related_pages 'ipt_emp_designation'><cms:show k_page_title /></cms:related_pages></cms:addslashes>",
        				"department":"<cms:addslashes><cms:related_pages 'ipt_emp_department'><cms:show k_page_title /></cms:related_pages></cms:addslashes>",
        				"mobilenumber":"<cms:addslashes><cms:show ipt_emp_mobile_number /></cms:addslashes>",
        				"dob":"<cms:addslashes><cms:date ipt_emp_dob format='M d, Y' /></cms:addslashes>"
    				</cms:pages>
                }
            </cms:if>
		}
	]
}	
<?php COUCH::invoke(); ?>