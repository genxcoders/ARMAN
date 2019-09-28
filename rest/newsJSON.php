<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='News - JSON' parent="_news_" />

<cms:ignore>Querystring Parameter</cms:ignore>
<cms:set userid="<cms:gpc 'userid' method='get' />" scope="global" />
<cms:set hashToken_url="<cms:gpc 'hashTokencheck' method='get' />" scope="global" />
<cms:set newsid="<cms:gpc 'newsid' method='get' />" scope="global" />

<cms:ignore>
<!-- 
	news_exists = 2, displays all news items
	news_exists = 1, displays single news item
	news_exists = 0, is error condition where no news item is available for display
 -->
</cms:ignore>

<cms:if hashToken_url ne "" >
	<cms:if userid ne "">
		<cms:query sql="SELECT p.id as page_id,p.page_name,cu.access_level FROM couch_pages p INNER JOIN couch_users cu on cu.title = p.page_title and cu.id = <cms:show userid /> WHERE p.template_id='3' ">
			<cms:set user_access_level="<cms:show access_level />" "global" />
			<cms:set user_page_id="<cms:show page_id />" "global" />
			<cms:set user_page_name="<cms:show page_name />" "global" />
		</cms:query>
	</cms:if>

	<cms:query sql="select COALESCE(count(hashToken),0) as hashcnt,COALESCE(id,0) as userid_set from couch_users where hashToken='<cms:show hashToken_url />' and id='<cms:show userid />'" >
		<cms:if hashcnt eq '1'>
			<cms:set hashToken_verify="1" "global" />
		<cms:else_if (hashcnt eq '0')/>
			<cms:set hashToken_verify="0" "global" />
		</cms:if>
	</cms:query>

	<cms:ignore>Check if News Exists</cms:ignore>
	<cms:set news_count="<cms:pages masterpage='news.php' custom_field="news_uid=<cms:show newsid />" count_only='1' />" />
	<cms:pages masterpage='news.php'>
		<cms:if (newsid eq '') && (news_count eq '0') >
			<cms:set news_exists="2" scope="global" />
		<cms:else_if (news_count eq '1') />
			<cms:set newsid=news_uid />
			<cms:set news_exists="1" scope="global" />
		<cms:else />
			<cms:set news_exists="0" scope="global" />
		</cms:if>
	</cms:pages>

	<cms:if hashToken_verify eq '1' &&  userid ne "">
		<cms:ignore>Generate JSON Conditionally</cms:ignore>
		<cms:content_type 'application/json'/>
		<cms:if news_exists eq "2" >
		{
			"allnewsjson":
			{
				"newsexists":"<cms:show news_exists />",
				"status":"SUCCESS",
				"message":"List of all news items",
				"data":
				[
					<cms:pages masterpage="news.php" show_future_entries='1' >
					{
						"uniquenewsId":"<cms:addslashes><cms:show news_uid /></cms:addslashes>",
						"uploadnewsTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
						"uploadednewsDate":"<cms:addslashes><cms:date k_page_date format='F d, Y' /></cms:addslashes>",
						"uniquenewsDesc":<cms:escape_json><cms:excerptHTML count='5'><cms:show news_desc /></cms:excerptHTML></cms:escape_json>,
						"page_id":"<cms:show k_page_id />"
					}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
					</cms:pages>
				]
			}
		}
		<cms:else_if news_exists eq "1" />
		{
			"newssinglejson":
			[
				<cms:pages masterpage="news.php" show_future_entries='1' custom_field="news_uid=<cms:show newsid />" >
				{
					"newsexists":"<cms:show news_exists />",
					"status":"SUCCESS",
					"message":"Selected news item details",
					"data":
					{
						"uniquenewsId":"<cms:addslashes><cms:show news_uid /></cms:addslashes>",
						"uploadnewsTitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
						"uploadednewsDate":"<cms:addslashes><cms:date k_page_date format='F d, Y' /></cms:addslashes>",
						"uniquenewsDesc":<cms:escape_json><cms:nl2br><cms:show news_desc /></cms:nl2br></cms:escape_json>
					}
				}
				</cms:pages>
			]
		}
		<cms:else_if news_exists eq "0" />
		{
			"newsfailjson":
			{
				"newsexists":"<cms:show news_exists />",
				"status":"FAILURE",
				"message":"News item does not exist",
				"data":{}
			}
		}
		</cms:if>
	<cms:else />
	{
		"Status":"You are not authenticated"
	}
	</cms:if>

<cms:else />
{
	"Status":"Hash Token Missing. Unable to authenticate."
}
</cms:if>
<?php COUCH::invoke(); ?>