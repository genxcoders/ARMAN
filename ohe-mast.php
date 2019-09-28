<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='OHE Mast' clonable='1' routable='1' parent='_ohe_' >
	<!-- Editables -->
	<cms:editable name='ipt_rec_no' label='Record Number' type='text' order='1' />
	<cms:editable name='ipt_div' label='Division' type='text' order='2' />
	<cms:editable name='ipt_sec' label='Section' type='text' order='3' />
	<cms:editable name='ipt_ohe_mast' label='OHE Mast' type='text' order='4' />
	<cms:editable name='ipt_lati' label='Latitude' type='text' order='5' />
	<cms:editable name='ipt_long' label='Longitude' type='text' order='6' />
	<cms:editable name='ipt_alti' label='Altitude' type='text' order='7' />
	<!-- Editables -->
	<!-- Department: Custom Routes -->
	<cms:route name='list_ohe' path='' />
	<cms:route name='create_ohe' path='create' />
    <cms:route name='edit_ohe' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_ohe' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Department: Custom Routes -->
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
					<cms:embed "ohe-mast/<cms:show k_matched_route />.html" />
					<!-- Helpline -->

				</div>
			</div>
			<!-- Content Here -->

		<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>