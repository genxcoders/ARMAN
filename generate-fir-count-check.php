<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Fir Count Check' parent='_fir_' order='5' />
<cms:content_type 'application/json'/>
{
	"count":<cms:escape_json><cms:pages masterpage='generate-fir.php' custom_field="fir_read_status <> 1" count_only='1' /></cms:escape_json>
}
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>