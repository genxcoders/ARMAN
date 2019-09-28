<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Toggle SOS State' />
<cms:set toggle_id="<cms:gpc 'id' method='get' />" scope='global' />
<cms:db_persist
	_auto_title         =   '0'
    _invalidate_cache   =   '0'
    _masterpage         =   'select-sos.php'
    _mode               =   'edit'
    _page_id			=	"<cms:show toggle_id />"
    
    sos_rad_status		=	"1"
>
	<cms:if k_error >
        <cms:abort>
	        <cms:each k_error >
	            <br><cms:show item />
	        </cms:each>
            <cms:ignore>
                <cms:if sos_rad_status=='1'>
                    <cms:set new_status="0" />
                <cms:else_if sos_rad_status=='0'/>
                    <cms:set new_status="1" />
                </cms:if>
            </cms:ignore>
        </cms:abort>
    <cms:else_if k_success />
        <cms:abort><cms:show sos_rad_status /></cms:abort>
    </cms:if>
</cms:db_persist>
<?php COUCH::invoke(); ?>

