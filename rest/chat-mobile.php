<?php require_once( '../couch/cms.php' ); ?>
<?php require_once( 'loginClass.php' ); ?>
<cms:template title='Chat Message - Mobile Submitted' order='1002' parent='_chat_' />

<cms:set userid="<cms:gpc 'userid' method='get' />" scope="global" />
<cms:set hashToken_url="<cms:gpc 'hashTokencheck' method='get' />" scope="global" />

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

	<cms:if hashToken_verify eq '1' &&  userid ne "">
		<cms:if user_page_id>
			<cms:content_type 'application/json' />
			<cms:set page_title="<cms:gpc 'msg' method='get' />" scope="global" />
		    <cms:set user_id="<cms:show user_page_id />" scope="global" />
		    <cms:set sos_id="<cms:show sosid />" scope="global" />
            <cms:db_persist
                _auto_title         =   '0'
                _invalidate_cache   =   '0'
                _masterpage         =   'chat-messages.php'
                _mode               =   'create'
                    
                k_page_title        =   "<cms:show page_title />"
                k_page_name         =   "<cms:show k_page_title />"
                user_id             =   "<cms:show user_id />"
                sos_id              =   "<cms:show sos_id />"
            >
            	<cms:if k_error >
                    {
                        "error":"0",
            	        <cms:each k_error >
                        "value":<cms:escape_json><cms:show item /><cms:if "<cms:not k_paginated_bottom />">,</cms:if></cms:escape_json>
            	        </cms:each>
                    }
                <cms:else />
                	{
                		"success":"1",
                		"id":"<cms:show k_last_insert_id />",
                        "title":<cms:escape_json><cms:show page_title /></cms:escape_json>
                	}
                </cms:if>
            </cms:db_persist>

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