<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Select SOS Receivers' clonable='1' routable='1' order='4' parent='_sos_'>
	<cms:editable name="send_sos" label="Send SOS" type="relation" masterpage="generate-sos.php" has="one" order="1" required='1' />
	<cms:editable name='fir_informer_name_submit' label='FIR Submited by' type='relation' has='one' masterpage='users/index.php' order='2' no_guix='1' class='col-md-8'/>
	<cms:editable name="emp_sos" label="Employee to whom SOS is to be Sent" type="relation" masterpage="users/index.php" order="2" required='1' />
	<cms:editable name="sos_alarm" label="Is Alarm Generated?" type="radio" opt_values="No=0 | Yes=1" option_selected="0" order='3' />
	<cms:editable name='sos_rad_status' label='SOS Status' type='radio' opt_values='Underway=0 | Completed=1' opt_selected='0' order='7' />
	<cms:editable name='selectsos_chat' type='relation' masterpage='chat.php' has='one' order='8' />
	<cms:editable name='selectsos_track' type='relation' masterpage='tracking/alarmtracker.php' has='one' order='9' />

	<!-- Department: Custom Routes -->
	<cms:route name='list_select_sos' path='' />
	<cms:route name='create_select_sos' path='create' />
	<cms:ignore>
    <cms:route name='edit_select_sos' path='{:id}/edit' >
    	<cms:route_validators id='non_zero_integer' />
	</cms:route>
	</cms:ignore>
	<cms:route name='view_select_sos' path='{:id}' >
        <cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='generated_sos_alarm' path='{:id}/generated' >
        <cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='delete_select_sos' path='{:id}/delete' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
	<cms:route name='page_view_select_sos' path='{:id}/pageview' >
	    <cms:route_validators id='non_zero_integer' />
	</cms:route>
    <!-- Department: Custom Routes -->
</cms:template>

	<cms:embed 'header.html' />

		<!-- Content Here -->
		<div class="container">
			<div class="row">
				<div class="gxcpl-ptop-30"></div>

				<cms:match_route debug='0' />

				<cms:embed "select-sos/<cms:show k_matched_route />.html" />

			</div>
		</div>
		<!-- Content Here -->

		<cms:ignore>
		<div class="row">
			<div class="col-md-12">
				<h4>Test for SOS Specific Chat Messages</h4>
				<br />
				<cms:pages masterapge="chat-messages.php" id="<cms:pages masterpage=k_template_name id=rt_id><cms:show k_page_id /></cms:pages>" >
					<cms:no_results>
						No Chats
					</cms:no_results>
					<cms:reverse_related_pages 'sos_id' masterpage='chat-messages.php'>
						<cms:show k_count />. <cms:show k_page_title /><br>
					</cms:reverse_related_pages>
				</cms:pages>
				<br />
				<cms:pages masterpage='select-sos.php' id=rt_id >
					<cms:show k_page_title /><br>
				</cms:pages>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h4>Test for SOS Specific Trackers on Map[<cms:pages masterpage=k_template_name id=rt_id><cms:show k_page_id /></cms:pages>]</h4>
				<br />
				<cms:pages masterapge="tracking/track.php" id="<cms:pages masterpage=k_template_name id=rt_id><cms:show k_page_id /></cms:pages>" >
					<cms:reverse_related_pages 'sosid' masterpage='tracking/track.php'>
						<cms:show k_count />. <cms:show k_page_title /><br>
					</cms:reverse_related_pages>
				</cms:pages>
				<br />
			</div>
		</div>
		</cms:ignore>


	<cms:embed 'footer.html' />
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>