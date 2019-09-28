<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Department JSON' order='101' icon='home' hidden='1 '/>
<cms:set hlid="<cms:gpc 'hlid' method='get' />" />
<cms:set hlpincode="<cms:gpc 'hlpincode' method='get' />" />
<cms:content_type 'application/json'/>
<cms:if hlid>
	{
		"helpline":
		[	
			<cms:pages masterpage='helpline.php' id=hlid custom_field="ipt_hlp_dept=<cms:show ipt_hlp_dept />" limit='1' show_future_entries='1'>
			{
				"hlid":"<cms:show k_page_id />",
				"department":"<cms:show ipt_hlp_dept />",
				"authority":"<cms:show k_page_title />",
				"number":"<cms:show ipt_hlp_number />",
				"pincode":"<cms:show ipt_hlp_pincode />"
			}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
			</cms:pages>
		]
	}
<cms:else />
	{
		"helpline":
		[	
			<cms:pages masterpage='helpline.php' order='asc' orderby='page_title' custom_field="ipt_hlp_dept=<cms:show ipt_hlp_dept /> | ipt_hlp_pincode=<cms:show hlpincode />" show_future_entries='1'>
			{
				"hlid":"<cms:show k_page_id />",
				"auth_char":"<cms:php>global $firstCharacter;$firstCharacter = "<cms:show k_page_title />"[0];echo $firstCharacter;</cms:php>",
				"department":"<cms:show ipt_hlp_dept />",
				"authority":"<cms:show k_page_title />",
				"number":"<cms:show ipt_hlp_number />",
				"location":"<cms:show ipt_hlp_url />",
				"pincode":"<cms:show ipt_hlp_pincode />"
			}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
			</cms:pages>
		]
	}
</cms:if>
<?php COUCH::invoke(); ?>