<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Departments' clonable='1' routable='1' parent='_master_' order='1' >
	<!-- Editables -->
	<cms:editable name='ipt_emp_department' label='Department' type='text' order='1' />
	<!-- Editables -->
	<!-- Department: Custom Routes -->
	<cms:route name='list_dept' path='' />
	<cms:route name='create_dept' path='create' />
    <cms:route name='edit_dept' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_dept' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Department: Custom Routes -->
    <!-- Admin View -->
	<cms:config_list_view>
	    <cms:field 'k_selector_checkbox' />
	    <cms:field 'k_page_title' />
	    <cms:field 'k_page_date' />
	    <cms:field 'k_actions' />
	</cms:config_list_view> 
    <!-- Admin View -->
</cms:template>
	<cms:embed 'header.html' />
			<!-- Department Form -->
			<div class="container">
				<div class="row">
					<div class="gxcpl-ptop-30"></div>

					<cms:match_route debug='0' />

					<cms:embed "department/<cms:show k_matched_route />.html" />

				</div>
			</div>
			<!-- Department Form -->
	<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>