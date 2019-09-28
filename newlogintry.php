<?php 
	require_once( 'couch/cms.php' ); 
	require_once( 'couch/auth/auth.php' );
	require_once( 'couch/auth/user.php' );
	require_once( 'couch/auth/PasswordHash.php' );
?>
<cms:template title="Aashish Try for Login Json - 14/04/2019" />
<cms:set username="<cms:gpc 'k_user_name' method='get' />" />
<cms:set password="<cms:gpc 'k_user_pwd' method='get' />" />
<cms:set cookie="<cms:set_cookie 'couchcms_testcookie' 'CouchCMS+test+cookie' />" />
<cms:ignore>
	<cms:gpc 'k_cookie_test' method='get' />
</cms:ignore>

<cms:if username && password && cookie>
	<cms:get_cookie 'couchcms_testcookie' 'CouchCMS+test+cookie' />
	<cms:process_login redirect='0' />
	<cms:if k_error>
		<cms:each k_error>
			Error: <cms:show item /><br>
		</cms:each>
	<cms:else_if k_success />
		<cms:redirect url="https://gxcpl.com/" />
	</cms:if>
</cms:if>
<?php COUCH::invoke(); ?>