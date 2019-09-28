<?php require_once( '../couch/cms.php' ); ?>
<?php require_once( 'loginClass.php' ); ?>
<cms:template title='All SOS - List' order='1002' parent='_rest_json_' />

<cms:set userid="<cms:gpc 'userid' method='get' />" scope="global" />
<cms:set hashToken_url="<cms:gpc 'hashTokencheck' method='get' />" scope="global" />
<cms:set sosid="<cms:gpc 'sosid' method='get' />" scope="global" />

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

	<cms:content_type 'application/json'/>

	<cms:set soscount="<cms:pages masterpage='select-sos.php' count_only='1' />" scope='global' />
	<cms:if fircount ge '1' >
		<cms:set show_json="1" scope="global" />
	<cms:else />
		<cms:set show_json="0" scope="global" />
	</cms:if>

	<cms:if hashToken_verify eq '1' &&  userid ne "">
		<cms:if user_page_id && sosid>
		{
			"HT Verify": "<cms:show hashToken_verify />",
			"sosstatus":"<cms:show soscount />",
			"user":"<cms:show user_page_id />",
			"sosJSON":
			{
				<cms:pages masterpage="select-sos.php" id=sosid show_future_entries='1' limit='1' >
					"sosId":"<cms:show k_page_id />",
					"sostitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
					<cms:related_pages 'send_sos'>
					"sosimage":
					[
						{
							"image":"<cms:if sos_disaster_image><cms:show_securefile 'sos_disaster_image'><cms:securefile_link file_id /></cms:show_securefile><cms:else /></cms:if>"
						}
					],
					"soslat":"<cms:addslashes><cms:if sos_lati ><cms:show sos_lati/><cms:else />NA</cms:if></cms:addslashes>",
					"soslong":"<cms:addslashes><cms:if sos_longi ><cms:show sos_longi /><cms:else />NA</cms:if></cms:addslashes>",
					"sosdesc":<cms:escape_json><cms:nl2br><cms:if sos_desc ><cms:show sos_desc /><cms:else />NA</cms:if></cms:nl2br></cms:escape_json>,
					"sosdate":"<cms:addslashes><cms:if sos_date ><cms:date sos_date format='M d, Y' /><cms:else />NA</cms:if></cms:addslashes>",
					"sostime":"<cms:addslashes><cms:if sos_time ><cms:date sos_time format='H:i' /><cms:else />NA</cms:if></cms:addslashes>",
					"sostrainno":"<cms:addslashes><cms:if sos_train_no ><cms:show sos_train_no /><cms:else />NA</cms:if></cms:addslashes>",
					"soslocono":"<cms:addslashes><cms:if sos_loco_no><cms:show sos_loco_no /><cms:else />NA</cms:if></cms:addslashes>",
					"sosohemast":"<cms:addslashes><cms:if sos_ohemast><cms:show sos_ohemast /><cms:else />NA</cms:if></cms:addslashes>",
					</cms:related_pages>
					<cms:related_pages 'fir_informer_name_submit'>
					"sosinformername":"<cms:addslashes><cms:no_results>NA</cms:no_results><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></cms:addslashes>",
					"sosinformerno":"<cms:addslashes><cms:no_results>NA</cms:no_results><cms:show ipt_emp_mobile_number /></cms:addslashes>"
					</cms:related_pages>
				</cms:pages>
			}
		}
		<cms:else_if user_page_id />
		{
			"HT Verify": "<cms:show hashToken_verify />",
			"sosstatus":"<cms:show soscount />",
			"user":"<cms:show user_page_id />",
			"allsosJSON":
			[
				<cms:pages masterpage="select-sos.php" show_future_entries='1' custom_field="sos_alarm=1" >
				{
					"sosId":"<cms:show k_page_id />",
					"sostitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
					<cms:related_pages 'send_sos'>
					"sosimage":
					[
						{
							"image":"<cms:addslashes><cms:if sos_disaster_image><cms:show_securefile 'sos_disaster_image'><cms:securefile_link file_id /></cms:show_securefile><cms:else /></cms:if></cms:addslashes>"
						}
					],
					"sosdate":"<cms:addslashes><cms:if sos_date ><cms:date sos_date format='M d, Y' /><cms:else />NA</cms:if></cms:addslashes>",
					"sosdesc":<cms:escape_json><cms:nl2br><cms:show sos_desc /></cms:nl2br></cms:escape_json>
					</cms:related_pages>
				}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
				</cms:pages>
			]
		}
		<cms:else />
		{
			"firstatus":"<cms:show fircount />",
			"user":"<cms:show k_user_id />",
			"allfirJSON":
			[]
		}
		</cms:if>
	<cms:else />
	{
		"Status":"You are not authenticated"
	}
	</cms:if>

<cms:else />
{
	"Status":"Hash Token Missing"
}
</cms:if>
<?php COUCH::invoke(); ?>