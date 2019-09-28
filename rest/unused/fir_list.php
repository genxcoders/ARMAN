<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='FIR - List' order='1001' parent='_rest_json_' />
<cms:if k_logged_out>
	<cms:redirect "<cms:login_link />" />
</cms:if>
<cms:set firid="<cms:gpc 'firid' method='get' />" scope="global" />

<cms:content_type 'application/json' />
{
	<cms:pages masterpage='generate-fir.php' show_future_entries="1" paginate='1' custom_field="<cms:if k_user_access_level lt '7'>ipt_informer_name=<cms:show k_user_name /></cms:if>" >
	"firJSON":
	{
		"username":"<cms:related_pages 'ipt_informer_name'><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></cms:related_pages>",
		"firId":"<cms:show k_page_id />",
		"firtitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>"
	}<cms:if "<cms:not k_paginated_bottom />">,</cms:if>
	</cms:pages>
}
<?php COUCH::invoke(); ?>