<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Toggle SOS State' />
<cms:set toggle_id="<cms:gpc 'id' method='get' />" scope='global' />
<cms:db_persist
	_auto_title         =   '0'
    _invalidate_cache   =   '0'
    _masterpage         =   'generate-fir.php'
    _mode               =   'edit'
    _page_id			=	"<cms:show toggle_id />"
    
    fir_read_status		=	"1"
>
	<cms:if k_error >
        <cms:abort>
	        <cms:each k_error >
	            <br><cms:show item />
	        </cms:each>
        </cms:abort>
    <cms:else_if k_success />
        <cms:abort><cms:show toggle_id /></cms:abort>
    </cms:if>
</cms:db_persist>
<?php COUCH::invoke(); ?>

