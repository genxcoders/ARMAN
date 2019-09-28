<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='OHE Mast' order='1001' parent='_rest_json_' />
<cms:content_type 'application/json'/>
<cms:set oheval="<cms:gpc 'oheval' method='get' />" />
{
	"oheval":
	[
		<cms:pages masterpage="ohe-mast.php" show_future_entries='1' >
		{
			"oheid":"<cms:show k_page_id />",
			"ohemast":"<cms:addslashes><cms:if ipt_ohe_mast eq '0' ><cms:show ipt_div /> <cms:show ipt_ohe_mast /><cms:else_if ipt_ohe_mast /><cms:show ipt_div /> <cms:show ipt_ohe_mast /><cms:else />NA</cms:if></cms:addslashes>",

			"latitude":"<cms:addslashes><cms:if ipt_lati ><cms:show ipt_lati /><cms:else />NA</cms:if></cms:addslashes>",

			"longitude":"<cms:addslashes><cms:if ipt_long ><cms:show ipt_long /><cms:else />NA</cms:if></cms:addslashes>"
		}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
		</cms:pages>
	]
}
<?php COUCH::invoke(); ?>