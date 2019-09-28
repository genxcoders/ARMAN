<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Global Site Settings' order='1' executable='0'>
	<!-- Site Branding (sb) -->
	<cms:editable name='sb' label='Site Branding' type='group' order='1' />
		<cms:editable name='sb_favicon' label='Favicon' desc='png image only' allowed_ext='png' type='image' show_preview='1' preview_width='16' group='sb' order='1' />
		<cms:editable name='sb_site_name' label='Site Name' desc='appears in navigation menu' type='text' group='sb' order='2' />
		<cms:editable name='sb_site_logo' label='Site Logo' type='image' show_preview='1' preview_width='100' group='sb' order='4' />
		<cms:editable name='sb_text_small' label='Heading 1' desc='small heading' type='text' group='sb' order='5' /> 
		<cms:editable name='sb_text_large' label='Heading 2' desc='large heading' type='text' group='sb' order='6' />
		<cms:editable name='sb_footer' label='Copyright' type='text' group='sb' order='7' />
	<!-- Site Branding -->
	<cms:editable name='google_map' label='API Keys' type='group' order='2' />
		<cms:editable name='map_api' label='Map API Key' type='text' group='google_map' order='1' />
		<cms:editable name='fcm_api' label='FCM API Key' type='text' group='google_map' order='2' />

	<cms:editable name='google_play' label='Google Play Store' type='group' order='3' />
		<cms:editable name='google_play_link' label='Download Link' type='text' group='google_play' order='1' />
</cms:template>
<?php COUCH::invoke(); ?>