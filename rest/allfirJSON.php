<?php require_once( '../couch/cms.php' ); ?>
<?php require_once( 'loginClass.php' ); ?>
<cms:template title='All FIR - List' order='1001' parent='_rest_json_' />

<cms:set userid="<cms:gpc 'userid' method='get' />" scope="global" />
<cms:set hashToken_url="<cms:gpc 'hashTokencheck' method='get' />" scope="global" />
<cms:set firid="<cms:gpc 'firid' method='get' />" scope="global" />

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

	<cms:set fircount="<cms:pages masterpage='generate-fir.php' custom_field="<cms:if user_access_level lt '7'>fir_informer_name=<cms:show user_page_name /></cms:if>" count_only='1' />" scope='global' />
	<cms:if fircount ge '1' >
		<cms:set show_json="1" scope="global" />
	<cms:else />
		<cms:set show_json="0" scope="global" />
	</cms:if>

	<cms:if hashToken_verify eq '1' &&  userid ne "">
		<cms:if user_page_id && firid>
		{
			"HT Verify": "<cms:show hashToken_verify />",
			"fircount":"<cms:show fircount />",
			"user":"<cms:show user_page_id />",
			"firJSON":
			{
				<cms:pages masterpage="generate-fir.php" id=firid custom_field="<cms:if user_access_level lt '7'>fir_informer_name=<cms:show user_page_name /></cms:if>" show_future_entries='1' limit='1' >
					"firId":"<cms:show k_page_id />",
					"firtitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
					"firimage":
					[
						{
							"image":"<cms:if fir_disaster_image><cms:show_securefile 'fir_disaster_image'><cms:securefile_link file_id /></cms:show_securefile><cms:else /></cms:if>"
						}
					],
					"firlat":"<cms:addslashes><cms:if fir_lati ><cms:show fir_lati/><cms:else />NA</cms:if></cms:addslashes>",
					"firlong":"<cms:addslashes><cms:if fir_longi ><cms:show fir_longi /><cms:else />NA</cms:if></cms:addslashes>",
					"firdesc":<cms:escape_json><cms:nl2br><cms:if fir_desc ><cms:show fir_desc /><cms:else />NA</cms:if></cms:nl2br></cms:escape_json>,
					"firdate":"<cms:addslashes><cms:if fir_date ><cms:date fir_date format='M d, Y' /><cms:else />NA</cms:if></cms:addslashes>",
					"firtime":"<cms:addslashes><cms:if fir_time ><cms:date fir_time format='H:i' /><cms:else />NA</cms:if></cms:addslashes>",
					"firtrainno":"<cms:addslashes><cms:if fir_train_no ><cms:show fir_train_no /><cms:else />NA</cms:if></cms:addslashes>",
					"firlocono":"<cms:addslashes><cms:if fir_loco_no><cms:show fir_loco_no /><cms:else />NA</cms:if></cms:addslashes>",
					"firohemast":"<cms:addslashes><cms:related_pages 'fir_ohemast'><cms:no_results>NA</cms:no_results><cms:show ipt_ohe_mast /></cms:related_pages></cms:addslashes>",
					"firinformername":"<cms:addslashes><cms:related_pages 'fir_informer_name'><cms:no_results>NA</cms:no_results><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></cms:related_pages></cms:addslashes>",
					"firinformerno":"<cms:addslashes><cms:related_pages 'fir_informer_name'><cms:no_results>NA</cms:no_results><cms:show ipt_emp_mobile_number /></cms:related_pages></cms:addslashes>"
				</cms:pages>
			}
		}
		<cms:else_if user_page_id />
		{
			"HT Verify": "<cms:show hashToken_verify />",
			"fircount":"<cms:show fircount />",
			"user":"<cms:show user_page_id />",
			"allfirJSON":
			[
				<cms:pages masterpage="generate-fir.php" custom_field="<cms:if user_access_level lt '7'>fir_informer_name=<cms:show user_page_name /></cms:if>" show_future_entries='1' >
				{
					"firId":"<cms:show k_page_id />",
					"firtitle":"<cms:addslashes><cms:show k_page_title /></cms:addslashes>",
					"firimage":
					[
						{
							"image":"<cms:addslashes><cms:if fir_disaster_image><cms:show_securefile 'fir_disaster_image'><cms:securefile_link file_id /></cms:show_securefile><cms:else /></cms:if></cms:addslashes>"
						}
					],
					"firdate":"<cms:addslashes><cms:if fir_date ><cms:date fir_date format='M d, Y' /><cms:else />NA</cms:if></cms:addslashes>",
					"firdesc":<cms:escape_json><cms:nl2br><cms:show fir_desc /></cms:nl2br></cms:escape_json>
				}<cms:if "<cms:not k_paginated_bottom />">, </cms:if>
				</cms:pages>
			]
		}
		<cms:else />
		{
			"fircount":"<cms:show fircount />",
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
	"Status":"Hash Token Missing. Unable to authenticate."
}
</cms:if>
<?php COUCH::invoke(); ?>