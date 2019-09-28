<?php require_once( '../../couch/cms.php' ); ?>
<cms:template title='Uploaded Reference Images - JSON' />

<cms:ignore><!-- Querystring Parameter --></cms:ignore>
<cms:set imgid="<cms:gpc 'imgid' method='get' />" scope="global" />

<cms:ignore><!-- Check if Image Exists --></cms:ignore>
<cms:set image_count="<cms:pages masterpage='upload-image.php' custom_field="image_uid=<cms:show imgid />" count_only='1' />" />
<cms:pages masterpage='upload-image.php'>
	<cms:if (imgid eq '') && (image_count eq '0') >
		<cms:set img_exists="2" scope="global" />
	<cms:else_if (image_count eq '1') />
		<cms:set imgid=image_uid />
		<cms:set img_exists="1" scope="global" />
	<cms:else />
		<cms:set img_exists="0" scope="global" />
	</cms:if>
</cms:pages>

<cms:ignore><!-- Generate JSON Conditionally --></cms:ignore>
<cms:content_type 'application/json'/>

<cms:if img_exists eq "2" >
{
	"allimagejson":
	{
		"imgexists":"<cms:show img_exists />",
		"status":"SUCCESS",
		"message":"List of all help resource images",
		"data":
		[
			<cms:pages masterpage="upload-image.php" show_future_entries='1' >
			{
				"uniqueimageId":"<cms:addslashes><cms:show image_uid /></cms:addslashes>",
				"uploadimageTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
				"uploadeimageDate":"<cms:addslashes><cms:date k_page_date /></cms:addslashes>",
				"uploadimageLink":"<cms:show_securefile 'ref_image' ><cms:securefile_link file_id /></cms:show_securefile>"
			}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
			</cms:pages>
		]
	}
}
<cms:else_if img_exists eq "1" />
{
	"imagesinglejson":
	[
		<cms:pages masterpage="upload-image.php" show_future_entries='1' custom_field="image_uid=<cms:show imgid />" >
		{
			"imgexists":"<cms:show img_exists />",
			"status":"SUCCESS",
			"message":"Selected help resource image details",
			"data":
			{
				"uniqueimageId":"<cms:addslashes><cms:show image_uid /></cms:addslashes>",
				"uploadimageTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
				"uploadeimageDate":"<cms:addslashes><cms:date k_page_date /></cms:addslashes>",
				"uploadimageLink":"<cms:show_securefile 'ref_image' ><cms:securefile_link file_id /></cms:show_securefile>"
			}
		}
		</cms:pages>
	]
}
<cms:else_if img_exists eq "0" />
{
	"imagefailjson":
	{
		"imgexists":"<cms:show img_exists />",
		"status":"FAILURE",
		"message":"Image does not exist",
		"data":{}
	}
}
</cms:if>
<?php COUCH::invoke(); ?>