<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Generate SOS' clonable='1' routable='1' parent='_sos_' order='1' access_level='7' >
	<!-- Editables -->
	<cms:editable name='sos_date_time' type='row' order='1'>
		<cms:editable name='sos_date' label='SOS Date' type='datetime' default_time='@current' show_labels='0' order='1' class='col-md-6' required='1' />
		<cms:editable name='sos_time' label='SOS Time' type='datetime' allow_time='1' show_labels='0' default_time='@current' minute_steps="1" only_time="1" order='2' class='col-md-6' required='1' />
	</cms:editable>
	<cms:editable name='sos_train_loco' type='row' order='2'>
		<cms:editable name='sos_train_no' label='Train Number' type='text' order='1' class='col-md-6' required='1' />
		<cms:editable name='sos_loco_no' label='Loco Number' type='text' order='2' validator="non_negative_integer | exact_len=5" class='col-md-6' />
	</cms:editable>
	<cms:editable name='sos_informer' type='row' order='3'>
		<cms:editable name='sos_informer_name' label='SOS Submited by' type='relation' has='one' masterpage='users/index.php' order='2' no_guix='1' class='col-md-8' required='1' />
		<cms:editable name='sos_informer_no' label='FIR Informer Mobile Number' type='text' order='3' class='col-md-4' required='1' />
	</cms:editable>
	<cms:editable name='sos_dimage' type='row' order='4'>
		<cms:editable name='sos_disaster_image' label='Disaster Image' type='securefile' show_preview='1' preview_width='150' allowed_ext="jpg, jpeg, png, bmp" class="col-md-4" order='1'/>
		<cms:editable name='sos_disaster_image_link' label='Disaster Image Link' type='text' order='2' class="col-md-4" />
		<cms:editable name='sos_di_64' label='Base64 Encoded' type='textarea' no_xss_check order='3' class="col-md-4"/>
	</cms:editable>
	<cms:editable name='sos_ohe_lat_long' type='row' order='5'>
		<cms:editable name='sos_ohemast' label='OHE Mast' type='relation' masterpage='ohe-mast.php' has="one" order='1' class='col-md-12' />
		<cms:editable name='sos_lati' label='Latitude' type='text' order='2' class='col-md-6' />
		<cms:editable name='sos_longi' label='Longitude' type='text' order='3' class='col-md-6' />
	</cms:editable>
	<cms:editable name='sos_desc' label='Description' type='textarea' order='6' required='1' />
 	
	<!-- Editables -->
	<!-- Department: Custom Routes -->
	<cms:route name='list_sos' path='' />
	<cms:route name='create_sos' path='create' />
    <cms:route name='edit_sos' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='view_sos' path='{:id}' >
        <cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_sos' path='{:id}/delete' >
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
					<cms:match_route debug='0' />
					<cms:embed "generate-sos/<cms:show k_matched_route />.html" />
					<!-- Helpline -->

				</div>
			</div>
			<!-- Content Here -->

		<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>