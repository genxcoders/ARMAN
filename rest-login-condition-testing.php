<?php require_once( 'couch/cms.php' ); ?>
<cms:template title="Aashish Try for Login Json" />
<cms:no_cache />
<cms:set username="<cms:gpc 'username' method='get' />" />
<cms:set password="<cms:gpc 'password' method='get' />" />
<cms:set fcmid="<cms:gpc 'fcmid' method='get' />" />

<h4>Values from cms:query tag:</h4>
<cms:capture into='sql'>
	SELECT id, email, fcmId
	FROM couch_users
	WHERE email="<cms:show username />"
</cms:capture>
<cms:query sql=sql limit='1' >
	<cms:set user_id="<cms:show id />" scope="global" />
	<cms:set user_name="<cms:show email />" scope="global" />
	<cms:set fcm_id="<cms:show fcmId />" scope="global" />
</cms:query>

<!-- User exists, i.e. email matches -->
<cms:if user_id>
<cms:set user_exists="1" />
{
	"usercheck":
	{
		"status":"200",
		"message":"User exists."
	}
}
<cms:else />
<cms:set user_exists="0" />
{
	"usercheck":
	{
		"status":"0",
		"message":"User does not exist."
	}
}
</cms:if>
<hr>
<!-- Password match? -->
<cms:set pass_word="<cms:pages masterpage=k_user_template custom_field="extended_user_id=<cms:show user_id />" limit='1'><cms:show ipt_psw /></cms:pages>" scope="global" />
<cms:if (user_exists eq '1') && (password ne '') >
	<cms:if password eq pass_word>
		<cms:set password_match="1" />
		<cms:set cookie="<cms:set_cookie 'k_cookie_test' '1' />" scope='global' />
		<!--
			<input type='hidden' name='k_cookie_test' value='1' /> 
			<cms:gpc 'k_cookie_test' method='get' /> 
		-->
		{
			"passwordcheck":
			{
				"status":"200",
				"message":"Password Match",
				"password_match":"<cms:show password_match />",
				"cookie":"<cms:get_cookie 'couchcms_testcookie' />"
			}
		}
	<cms:else />
		<cms:set password_match="0" />
		{
			"passwordcheck":
			{
				"status":"0",
				"message":"Wrong Password"
			}
		}
	</cms:if>
<cms:else_if (user_exists eq '1') && (password eq '') />
	<cms:set password_match="2" />
		{
			"passwordcheck":
			{
				"status":"1",
				"message":"Password Required"
			}
		}
</cms:if>
<hr>
<!-- FCM Id exists || FCM Id blank -->
<cms:if (user_exists eq '1') && (password_match eq '1') && (fcmid ne '')>
	<cms:pages masterpage=k_user_template custom_field="extended_user_id=<cms:show user_id />" >
	<cms:if fcmid eq ipt_emp_registration_ids>
		<cms:set fcmid_exists="1" />
		{
			"status":"200",
			"message":"FCM Token match"
		}
	<cms:else_if fcmid ne ipt_emp_registration_ids />
		<cms:db_persist
			_masterpage=k_user_template
		    _mode='edit'
		    _page_id=k_page_id
		    _invalidate_cache='0'
		    _auto_title='0'

		    ipt_emp_registration_ids	=	"<cms:show fcmid />"
		>
		<cms:set fcmid_exists="1" />
		{
			"status":"1",
			"message":"FCM Token updated"
		}
		</cms:db_persist>
	</cms:if>
	</cms:pages>
<cms:else_if (user_exists eq '1') && (password_match eq '1') && (fcmid eq '') />
	<cms:set fcmid_exists="0" />
	{
		"status":"0",
		"message":"FCM Token required"
	}
</cms:if>
<?php COUCH::invoke(); ?>