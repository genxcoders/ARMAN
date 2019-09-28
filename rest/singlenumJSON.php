<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Department JSON' order='101' icon='home' hidden='1' parent='_rest_json_' />
<cms:content_type 'application/json'/>
{
	"helplinePermanent":"+91<cms:pages masterpage='prhelpline.php' limit='1'><cms:show k_page_title /></cms:pages>"
}
<?php COUCH::invoke(); ?>