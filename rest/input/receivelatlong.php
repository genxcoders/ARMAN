<?php require_once( '../../couch/cms.php' ); ?>
<cms:template title='Receive Latitude and Longitude' />
<cms:set userid="<cms:gpc 'userid' method='get' />" />
<cms:set latitude="<cms:gpc 'latitude' method='get' />" />
<cms:set longitude="<cms:gpc 'longitude' method='get' />" />
<cms:set status="<cms:gpc 'status' method='get' />" />
<cms:set sosid="<cms:gpc 'sosid' method='get' />" />

<cms:content_type 'application/json'/>
<cms:db_persist
    _auto_title       	= 	'0'
    _invalidate_cache 	= 	'0'
    _masterpage       	= 	'tracking/track.php'
    _mode             	= 	'create'

    k_page_title	    = 	"<cms:show userid />_<cms:show sosid />"
    k_page_name			=	"<cms:show k_page_title />"

    userid				=	"<cms:show userid />"
    latitude			=	"<cms:show latitude />"
    longitude			=	"<cms:show longitude />"
    status				=	"<cms:show status />"
    sosid				=	"<cms:show sosid />"
>
	<cms:if k_error >
        {
        	"success":"0",
        	"error":"<cms:each k_error ><cms:show item />, </cms:each>"
        }
    <cms:else />
    	{
    		"success":"1",
    		"id":"<cms:show k_last_insert_id />",
    		"title":<cms:escape_json><cms:nl2br><cms:show k_page_title /></cms:nl2br></cms:escape_json>
    	}
    </cms:if>
</cms:db_persist>
<?php COUCH::invoke(); ?>