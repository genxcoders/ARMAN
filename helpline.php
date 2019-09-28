<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Helpline' clonable='1' routable='1' parent='_helpline_' order='1' >
	<!-- Editables -->
	<cms:editable name='ipt_hlp_dept' label='Department' type='dropdown' opt_values="
	Select Department Type =- | <cms:pages masterpage='department.php'><cms:show k_page_title /><cms:if "<cms:not k_paginated_bottom />"> | </cms:if></cms:pages>" order='1' required='1' />
	<cms:editable name='ipt_hlp_number' label='Helpline Number' validator='non_negative_integer' type='text' order='2' required='1' />
	<cms:editable name='ipt_hlp_url' label='Location URL' desc='use short link from embed map in google maps | do not use http:// or https://' type='text' order='3' />
	<cms:editable name='ipt_hlp_pincode' label='Pincode' type='text' order='5' required='1' />
	<!-- Editables -->
	<!-- Department: Custom Routes -->
	<cms:route name='list_help' path='' />
	<cms:route name='create_help' path='create' />
    <cms:route name='edit_help' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_help' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Department: Custom Routes -->
    <cms:config_list_view>
	    <cms:field 'k_selector_checkbox' />
	    <cms:field 'k_page_title' />
	    <cms:field 'ipt_hlp_dept' header='Department' />
	    <cms:field 'k_page_date' />
	    <cms:field 'k_actions' />
	</cms:config_list_view>
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
					<cms:embed "helpline/<cms:show k_matched_route />.html" />
					<!-- Helpline -->

				</div>
			</div>
			<!-- Content Here -->

		<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>