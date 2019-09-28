<?php require_once( 'couch/cms.php' ); ?>
<cms:template title="Reference Materials - File" parent='_reference_' clonable='1' routable='1'>
	<cms:editable type='uid' name='file_uid' search_type='integer' order='1' />
	<cms:editable name='ref_file_title' label='File Title' type='text' order='2' required='1' />
	<cms:editable name='ref_file' label='Reference File' allowed_ext='txt,doc,docx,xls,xlsx,pdf' max_size="4096" type='securefile' order='3' required='1' />
	<!-- Routes -->
	<cms:route name='list_uploadfile' path='' />
    <cms:route name='create_uploadfile' path='create' />
    <cms:route name='edit_uploadfile' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_uploadfile' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Routes -->
</cms:template>
<cms:embed 'header.html' />
	<!-- Content Here -->
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
			<cms:embed "upload/file/<cms:show k_matched_route />.html" />
			<!-- Helpline -->

		</div>
	</div>
	<!-- Content Here -->
<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>