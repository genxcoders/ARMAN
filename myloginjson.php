<?php 
	require_once( 'couch/cms.php' );
	require_once( 'couch/auth/auth.php' );
	require_once( 'couch/auth/user.php' );
	require_once( 'couch/auth/PasswordHash.php' );
?>
<cms:template title="Aashish Try for Login Json" />
<cms:no_cache />
<cms:ignore>
	Get querystring parameters and save them to variables [USERNAME, PASSWORD, FCMID]
</cms:ignore>
<cms:set username="<cms:gpc 'username' method='get' />" />
<cms:set password="<cms:gpc 'password' method='get' />" />
<cms:set fcmid="<cms:gpc 'fcmid' method='get' />" />


<cms:ignore>
	Query User id based on the username (email address) and set the query result in variables [USER_ID, USER_NAME]
</cms:ignore>
<cms:capture into='sql'>
	SELECT id, email
	FROM couch_users
	WHERE email="<cms:show username />"
</cms:capture>
<cms:query sql=sql limit='1' >
	<cms:set user_id="<cms:show id />" scope="global" />
	<cms:set user_name="<cms:show email />" scope="global" />
</cms:query>

<cms:ignore>
	If USER_ID variable is set then set variable USER_EXISTS TO '1' ELSE TO '0'
</cms:ignore>
<cms:if user_id>
	<cms:set user_exists="1" scope="global" />
<cms:else />
	<cms:set user_exists="0" scope="global" />
</cms:if>


<cms:ignore>
	Compare user password. Set variable PASSWORD_MATCH TO '1' ELSE TO '0'
</cms:ignore>
<cms:set pass_word="<cms:pages masterpage=k_user_template custom_field="extended_user_id=<cms:show user_id />" limit='1'><cms:show ipt_psw /></cms:pages>" scope='global' />
<cms:if (user_exists eq '1') && (password ne '') >
	<cms:if password eq pass_word>		
		<cms:set password_match="1" scope="global" />
		<cms:php>
			$n='20';
			$hast=bin2hex($this->getName($n));
			/////////////////////////////////////////////
			$sql = "UPDATE ".K_TBL_USERS." SET  
			hashToken ='".$hast."',
			fcmId ='".$fcm_id."'
			WHERE 
			id='".$DB->sanitize( $rtty )."'";
			if($DB->_query( $sql )){
				return $hast;
			}
		</cms:php>
		<cms:set hasToken2="<cms show hast />" />
		<cms:show hasToken2 />
	<cms:else />
		<cms:set password_match="0" scope="global" />
	</cms:if>
<cms:else_if (user_exists eq '1') && (password eq '') />
	<cms:set password_match="2" scope="global" />
</cms:if>

<cms:if (user_exists eq '1') && (password_match eq '1') && (fcmid ne '')>
	<cms:pages masterpage='users/index.php' custom_field="extended_user_id=<cms:show user_id />" >
	<cms:if fcmid eq ipt_emp_registration_ids>
		<cms:set fcmid_exists="1" scope="global" />
	<cms:else_if fcmid ne ipt_emp_registration_ids />
		<cms:db_persist
			_masterpage=k_user_template
		    _mode='edit'
		    _page_id=k_page_id
		    _invalidate_cache='0'
		    _auto_title='0'

		    ipt_emp_registration_ids	=	"<cms:show fcmid />"
		>
			<cms:if k_error>
				Error: <cms:show item /><br>
				<cms:set fcmid_exists="0" scope="global" />
			<cms:else_if k_success />
				<cms:set fcmid_exists="1" scope="global" />
			</cms:if>
		</cms:db_persist>
	</cms:if>
	</cms:pages>
<cms:else_if (user_exists eq '1') && (password_match eq '1') && (fcmid eq '') />
	<cms:set fcmid_exists="0" scope="global" />
</cms:if>


<cms:if (user_exists eq '1') && (password_match eq '1') && (fcmid_exists eq '1')>
{
	"hashID":
	{
		"status_code":"200",
		"message":"Login Successful",
		"data":
		{
			"user":
			{
				<cms:pages masterpage=k_user_template show_future_entries='1' custom_field="extended_user_id=<cms:show user_id />" >
				"userid":"<cms:show extended_user_id />",
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
		}
	}
}
<cms:else />
{
	"hashID":
	{
		"status_code":"412",
		"message":"Login failed",
		"a":"<cms:show user_exists />",
		"b":"<cms:show password_match />",
		"c":"<cms:show fcmid_exists />"
	}
}
</cms:if>
<?php COUCH::invoke(); ?>