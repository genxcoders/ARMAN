<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='OTP Handler' order='100' hidden='1' icon='home' />
<cms:content_type 'application/json'/>
<cms:set email="<cms:gpc 'email' method='get' />" />
<cms:if email>
{
	"UserDetails" :
	[
			{
				"status" : "Exists", 
				"code" : "1", 
				"num":"<cms:show k_user_name />", 
				"dept":"<cms:show ipt_emp_department />"
			}
	]
}
<cms:else_if email='' />
{
	"UserDetails" :
	[
			{
				"status" : "Blank", 
				"code" : "0", 
				"num":"-", 
				"dept":"-"
			}
	]
}
</cms:if>
<?php COUCH::invoke(); ?>