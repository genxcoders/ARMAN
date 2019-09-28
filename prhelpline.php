<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Permanent Helpline Number' clonable='1' routable='1' parent='_prhelpline_' order='1' >
	<cms:editable name="prhelpline_num" label="Permanent Helpline Number" type="text" order="1" validator="non_negative_integer" required="1" />
	
	<!-- Permanent Helpline: Custom Routes -->
	<cms:route name='list_prhelp' path='' />
	<cms:route name='create_prhelp' path='create' />
    <cms:route name='edit_prhelp' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_prhelp' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Permanent Helpline: Custom Routes -->
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
					<cms:embed "prhelpline/<cms:show k_matched_route />.html" />
					<!-- Helpline -->

				</div>
			</div>
			<!-- Content Here -->

		<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>