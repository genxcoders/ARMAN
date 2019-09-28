<?php require_once( '../couch/cms.php' ); ?>
<?php require_once( '../rest/loginClass.php' ); ?>
<cms:template title='Tracking - Mobile Submitted' order='1002' parent='_track_' />
<cms:set sosid="2410" scope="global" />

<cms:content_type 'application/json' />
{
	"testLocs":
	{
		<cms:pages masterpage='tracking/track.php' id="<cms:reverse_related_pages 'sosid' masterpage='tracking/track.php'><cms:show k_page_id /></cms:reverse_related_pages>" custom_field="sosid=<cms:reverse_related_pages 'sosid' masterpage='tracking/track.php'><cms:show k_page_id /></cms:reverse_related_pages>" >
    	<cms:if status eq '1'>
    		<cms:related_pages 'userid'>
    			"<cms:show extended_user_id />":
    		</cms:related_pages>
    		{ 
    			"info":<cms:escape_json><cms:show status /></cms:escape_json>, 
    			"lat":<cms:escape_json><cms:show user_latitude /></cms:escape_json>, 
    			"lng":<cms:escape_json><cms:show user_longitude /></cms:escape_json>
    		}<cms:if "<cms:not k_paginated_bottom />">,</cms:if>
    	</cms:if>
    	</cms:pages>
	}
}
<?php COUCH::invoke(); ?>