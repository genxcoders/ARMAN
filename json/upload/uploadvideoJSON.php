<?php require_once( '../../couch/cms.php' ); ?>
<cms:template title='Uploaded Reference Video - JSON' />

<cms:ignore>Querystring Parameter</cms:ignore>
<cms:set vidid="<cms:gpc 'vidid' method='get' />" scope="global" />

<cms:ignore>Check if Video Exists</cms:ignore>
<cms:set video_count="<cms:pages masterpage='upload-video.php' custom_field="video_uid=<cms:show vidid />" count_only='1' />" />
<cms:pages masterpage='upload-video.php'>
	<cms:if (vidid eq '') && (video_count eq '0') >
		<cms:set vid_exists="2" scope="global" />
	<cms:else_if (video_count eq '1') />
		<cms:set vidid=video_uid />
		<cms:set vid_exists="1" scope="global" />
	<cms:else />
		<cms:set vid_exists="0" scope="global" />
	</cms:if>
</cms:pages>

<cms:ignore>Generate JSON Conditionally</cms:ignore>
<cms:content_type 'application/json'/>
<cms:if vid_exists eq "2" >
{
	"allvideojson":
	{
		"videxists":"<cms:show vid_exists />",
		"status":"SUCCESS",
		"message":"List of all help resource videos",
		"data":
		[
			<cms:pages masterpage="upload-video.php" show_future_entries='1' >
			{
				"uniquevideoId":"<cms:addslashes><cms:show video_uid /></cms:addslashes>",
				"uploadvideoTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
				"uploadvideoLink":"https://www.youtube.com/watch?v=<cms:show ref_video />",
				"uploadvideoimage":"https://img.youtube.com/vi/<cms:show ref_video />/mqdefault.jpg"

			}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
			</cms:pages>
		]
	}
}
<cms:else_if vid_exists eq "1" />
{
	"videosinglejson":
	[
		<cms:pages masterpage="upload-video.php" show_future_entries='1' custom_field="video_uid=<cms:show vidid />" >
		{
			"videxists":"<cms:show vid_exists />",
			"status":"SUCCESS",
			"message":"Selected help resource video details",
			"data":
			{
				"uniquevideoId":"<cms:addslashes><cms:show video_uid /></cms:addslashes>",
				"uploadvideoTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
				"uploadvideoLink":"https://www.youtube.com/watch?v=<cms:show ref_video />"
			}
		}
		</cms:pages>
	]
}
<cms:else_if vid_exists eq "0" />
{
	"videofailjson":
	{
		"videxists":"<cms:show vid_exists />",
		"status":"FAILURE",
		"message":"Video does not exist",
		"data":{}
	}
}

</cms:if>
<?php COUCH::invoke(); ?>