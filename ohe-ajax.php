<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='OHE Value: Lat &amp; Long' order='1' />
<cms:set ohe_val="<cms:gpc 'keyname' method='get' />" scope="global" />
<cms:content_type 'application/json'/>
{
	"receive":
	[
		<cms:pages masterpage='ohe-mast.php' id="<cms:show ohe_val />">
		{	
			"latitude": <cms:escape_json><cms:show ipt_lati /></cms:escape_json>,
			"longitude": <cms:escape_json><cms:show ipt_long /></cms:escape_json>
		}<cms:if "<cms:not k_paginated_bottom />">,</cms:if>
		</cms:pages>
	]	
}
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>