<?php require_once( '../../couch/cms.php' ); ?>
<cms:template title='Uploaded Reference Files - JSON' />

<cms:ignore>Querystring Parameter</cms:ignore>
<cms:set fileid="<cms:gpc 'fileid' method='get' />" scope="global" />

<cms:ignore>Check if File Exists</cms:ignore>
<cms:set file_count="<cms:pages masterpage='upload-file.php' custom_field="file_uid=<cms:show fileid />" count_only='1' />" />
<cms:pages masterpage='upload-file.php'>
	<cms:if (fileid eq '') && (file_count eq '0') >
		<cms:set file_exists="2" scope="global" />
	<cms:else_if (file_count eq '1') />
		<cms:set fileid=file_uid />
		<cms:set file_exists="1" scope="global" />
	<cms:else />
		<cms:set file_exists="0" scope="global" />
	</cms:if>
</cms:pages>

<cms:ignore>Generate JSON Conditionally</cms:ignore>
<cms:content_type 'application/json'/>
<cms:if file_exists eq "2" >
{
	"allfilejson":
	{
		"fileexists":"<cms:show file_exists />",
		"status":"SUCCESS",
		"message":"List of all help resource files",
		"data":
		[
			<cms:pages masterpage="upload-file.php" show_future_entries='1' >
			{
				"uniquefileId":"<cms:addslashes><cms:show file_uid /></cms:addslashes>",
				"uploadfileTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
				"uploadedfileDate":"<cms:addslashes><cms:date k_page_date format='F d, Y' /></cms:addslashes>",
				<cms:show_securefile 'ref_file'>
				"uploadfileLink":"<cms:securefile_link file_id />",
				"uploadfileext":"<cms:addslashes><cms:show file_ext /></cms:addslashes>"
				</cms:show_securefile>
			}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
			</cms:pages>
		]
	}
}
<cms:else_if file_exists eq "1" />
{
	"filesinglejson":
	[
		<cms:pages masterpage="upload-file.php" show_future_entries='1' custom_field="file_uid=<cms:show fileid />" >
		{
			"fileexists":"<cms:show file_exists />",
			"status":"SUCCESS",
			"message":"Selected help resource file details",
			"data":
			{
				"uniquefileId":"<cms:addslashes><cms:show file_uid /></cms:addslashes>",
				"uploadfileTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
				"uploadedfileDate":"<cms:addslashes><cms:date k_page_date format='F d, Y' /></cms:addslashes>",
				<cms:show_securefile 'ref_file'>
				"uploadfileLink":"<cms:securefile_link file_id />",
				"uploadfileext":"<cms:addslashes><cms:show file_ext /></cms:addslashes>"
				</cms:show_securefile>
			}
		}
		</cms:pages>
	]
}
<cms:else_if file_exists eq "0" />
{
	"filefailjson":
	{
		"fileexists":"<cms:show file_exists />",
		"status":"FAILURE",
		"message":"file does not exist",
		"data":{}
	}
}
</cms:if>
<?php COUCH::invoke(); ?>