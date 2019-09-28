<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='TO DO JSON' order='105' icon='home' parent='_rest_json_' hidden='1 '/>
<cms:content_type 'application/json'/> 
{
	"todotitle":"",
	"todo":
	[	
		<cms:pages masterpage='to-do.php' show_future_entries='1'>
		{
			"todotitle":<cms:escape_json><cms:show k_page_title /></cms:escape_json>,
			"tododesc":<cms:escape_json><cms:nl2br><cms:show to_do_desc /></cms:nl2br></cms:escape_json>
		}
		<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
		</cms:pages>
	]
}
<?php COUCH::invoke(); ?>