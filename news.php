<?php require_once( 'couch/cms.php' ); ?>
<cms:template title="News" clonable='1' routable='1' parent='_news_' >
	<cms:editable type='uid' name='news_uid' search_type='integer' order='1' />
	<cms:editable type='text' name='news_title' label='News Title' order='2' />
	<cms:editable name='news_desc' label="To Do Description" type="textarea" no_xss_check='1' order='3' />
	<!-- Routes -->
	<cms:route name='list_news' path='' />
    <cms:route name='create_news' path='create' />
    <cms:route name='edit_news' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='view_news' path='{:id}' />
	<cms:route name='delete_news' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Routes -->
</cms:template>
<cms:embed 'header.html' />
	<div class="container">
		<div class="row">
			<div class="gxcpl-ptop-30"></div>

			<!-- Section Divider -->
			<div class="gxcpl-ptop-10"></div>
			<!-- <div class="gxcpl-divider-dark"></div> -->
			<div class="gxcpl-ptop-10"></div>
			<!-- Section Divider -->

			<!-- Helpline -->
			<cms:match_route debug='0' />
			<cms:embed "news/<cms:show k_matched_route />.html" />
			<!-- Helpline -->
		</div>
	</div>
<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>