<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='FIR Form' clonable='1' routable='1' parent='_fir_' order='1' >
	<!-- Editables -->

	<cms:editable name='fir_date' label='FIR Date' type='datetime' default_time='@current' show_labels='0' order='1' format='Y-m-d' required='1' />
	<cms:editable name='fir_time' label='FIR Time' type='datetime' allow_time='1' default_time='@current' show_labels='0' minute_steps="1" only_time="1" order='2' required='1' />

	<cms:editable name='fir_train_no' label='Train Number' type='text' order='3' required="1" />
	<cms:editable name='fir_loco_no' label='Loco Number' type='text' order='4' validator="non_negative_integer | exact_len=5" />

	<cms:editable name='fir_informer_name' label='FIR Submited by' type='relation' has='one' masterpage='users/index.php' order='5' no_guix='1' required='1'/>
	<cms:editable name='fir_informer_no' label='FIR Informer Mobile Number' type='text' order='6' required='1' />


	<cms:editable name='fir_disaster_image' label='FIR Disaster Image' type='securefile' show_preview='1' preview_width='150' order='4' no_gui='1' order='7' />
	<cms:editable name='fir_disaster_image_link' label='FIR Disaster Image Link' type='text' order='8' />
	<cms:editable name='fir_di_64' label='FIR Image Base64 Encoded' type='textarea' no_xss_check order='9' />


	<cms:editable name='fir_ohemast' label='FIR OHE Mast' type='relation' masterpage='ohe-mast.php' has="one" order='10' />
	<cms:editable name='fir_lati' label='FIR Latitude' type='text' order='11' />
	<cms:editable name='fir_longi' label='FIR Longitude' type='text' order='12' />
	
	<cms:editable name='fir_desc' label='FIR Description' type='textarea' order='13' required='1' />

	<cms:editable name='fir_read_status' label='FIR Read or Not?' type='checkbox' order='14' opt_values="Yes=1" />
	<!-- Editables -->
	<!-- Department: Custom Routes -->
	<cms:route name='list_fir' path='' />
	<cms:route name='create_fir' path='create' />
	<cms:ignore>
    <cms:route name='edit_fir' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	</cms:ignore>
	<cms:route name='view_fir' path='{:id}' >
		<cms:route_validators id='non_zero_integer' />
	</cms:route>
        
	<cms:route name='delete_fir' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Department: Custom Routes -->
</cms:template>
	<cms:embed 'header.html' />

			<!-- Content Here -->
			<div class="container">
				<div class="row">
					<div class="gxcpl-ptop-30"></div>

					<!-- Helpline -->
					<cms:match_route debug='0' is_404='1' />
					<cms:embed "generate-fir/<cms:show k_matched_route />.html" />
					<!-- Helpline -->

				</div>
			</div>
			<!-- Content Here -->

		<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>