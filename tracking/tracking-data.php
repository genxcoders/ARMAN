<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Receive Tracking Data' parent='_track_' />

<cms:set hashToken_url="<cms:gpc 'hashTokencheck' method='get' />" scope="global" />
<cms:set userid="<cms:gpc 'userid' method='get' />" scope="global" />

<cms:if hashToken_url ne "" >
    <cms:if userid ne "">
        <cms:query sql="SELECT p.id as page_id,p.page_name,cu.access_level FROM couch_pages p INNER JOIN couch_users cu on cu.title = p.page_title and cu.id = <cms:show userid /> WHERE p.template_id= 3 ">
            <cms:set user_access_level="<cms:show access_level />" scope="global" />
            <cms:set user_page_id="<cms:show page_id />" scope="global" />
            <cms:set user_page_name="<cms:show page_name />" scope="global" />
        </cms:query>
    </cms:if>

    <cms:query sql="select COALESCE(count(hashToken),0) as hashcnt,COALESCE(id,0) as userid_set from couch_users where hashToken='<cms:show hashToken_url />' and id='<cms:show userid />'" >
        <cms:if hashcnt eq '1'>
            <cms:set hashToken_verify="1" scope="global" />
        <cms:else_if hashcnt eq '0' />
            <cms:set hashToken_verify="0" scope="global" />
        </cms:if>
    </cms:query>

    <cms:set user_latitude="<cms:gpc 'user_latitude' method='get' />" scope='global' />
	<cms:set user_longitude="<cms:gpc 'user_longitude' method='get' />" scope='global' />
	<cms:set status="<cms:gpc 'status' method='get' />" scope='global' />
	<cms:set sosid="<cms:gpc 'sosid' method='get' />" scope='global' />

    <cms:if hashToken_verify eq '1' &&  userid ne "">
        <cms:if user_page_id && sosid>

			<cms:content_type 'application/json'/>

			<cms:set my_template_name = 'tracking/track.php' />
		    <cms:set my_page_title = "<cms:show userid /> <cms:show sosid />" />
		    <cms:php>
		        global $CTX, $FUNCS;
		        $name = $FUNCS->get_clean_url( "<cms:show my_page_title />" );
		        $CTX->set( 'my_page_name', $name ); 
		    </cms:php> 
		    <cms:set my_page_id = '' 'global' />
		    <cms:pages masterpage=my_template_name page_name=my_page_name limit='1' show_future_entries='1'>
		        <cms:set my_page_id=k_page_id  'global' />
		    </cms:pages>
		    <cms:if my_page_id=''>
				<cms:ignore><!-- New Entry --></cms:ignore>
				<cms:db_persist
					_masterpage="tracking/track.php"
					_mode="create"
					_invalidate_cache="0"
					_auto_title="0"

					k_page_title	=	"<cms:show userid /> <cms:show sosid />"
					k_page_name		=	"<cms:show k_page_title />"
					userid			=	"<cms:show user_page_id />"
					user_latitude	=	"<cms:show user_latitude />"
					user_longitude	=	"<cms:show user_longitude />"
					status			=	"<cms:show status />"
					sosid			=	"<cms:show sosid />"
				>
					<cms:if k_error>
						{
				            "error":"0",
					        <cms:each k_error >
				            "value":<cms:escape_json><cms:show item /></cms:escape_json><cms:if "<cms:not k_last_item />">,</cms:if>
					        </cms:each>
				        }
					<cms:else_if k_success />
						{
				    		"success":"1",
				    		"id":"<cms:show sosid />",
				    		"message":<cms:escape_json>Tracking marker created.</cms:escape_json>,
				    		"k_page_title":"<cms:show userid /> <cms:show sosid />",
							"userid":"<cms:show user_page_id />",
							"user_latitude":"<cms:show user_latitude />",
							"user_longitude":"<cms:show user_longitude />",
							"status":"<cms:show status />",
							"sosid":"<cms:show k_last_insert_id />"
				    	}
					</cms:if>
				</cms:db_persist>
				<cms:ignore><!-- New Entry --></cms:ignore>
			<cms:else />
				<cms:ignore><!-- Update Entry --></cms:ignore>
				<cms:db_persist
					_masterpage="tracking/track.php"
					_mode="edit"
					_page_id="<cms:show my_page_id />"
					_invalidate_cache="0"
					_auto_title="0"

					user_latitude	=	"<cms:show user_latitude />"
					user_longitude	=	"<cms:show user_longitude />"
					status			=	"<cms:show status />"
				>
					<cms:if k_error>
						{
				            "error":"0",
					        <cms:each k_error >
				            "value":<cms:escape_json><cms:show item /></cms:escape_json><cms:if "<cms:not k_last_item />">,</cms:if>
					        </cms:each>
				        }
					<cms:else_if k_success />
						{
				    		"success":"2",
				    		"id":"<cms:show sosid />",
				            "message":<cms:escape_json>Tracking marker position updated.</cms:escape_json>,
				            "k_page_title":"<cms:show userid /> <cms:show sosid />",
							"userid":"<cms:show user_page_id />",
							"user_latitude":"<cms:show user_latitude />",
							"user_longitude":"<cms:show user_longitude />",
							"status":"<cms:show status />",
							"sosid":"<cms:show k_last_insert_id />"
				    	}
					</cms:if>
				</cms:db_persist>
				<cms:ignore><!-- Update Entry --></cms:ignore>
			</cms:if>
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