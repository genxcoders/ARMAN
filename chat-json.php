<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Chat JSON' parent="_chat_" order='2' />

	<cms:set sosid_chat="<cms:gpc 'sosid' method='get' />" scope='global' />
	<!-- Set User Name -->
	<cms:if k_logged_in>
		<cms:pages masterpage=k_user_template id=k_user_id limit='1' >
			<cms:set logged_in_user_id = "<cms:show k_page_id />" scope="global" />
		</cms:pages>
	</cms:if>
	<!-- Set User Name -->
	<br>
	





	<cms:pages masterpage='select-sos.php' id=sosid_chat>
	<cms:related_pages 'selectsos_chat'>
		<cms:reverse_related_pages 'chatmessage_chat' masterpage='chat-messages.php' order='desc' id=sosid_chat>
			<cms:related_pages 'user_id' >
				<cms:set other_user_id = "<cms:show k_page_id />" scope="global" />
			</cms:related_pages>
			
			<cms:no_results>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<h3 class="text-center text-muted">
						No messages yet!
					</h3>
				</div>
			</div>
			</cms:no_results>

			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="gxcpl-chat-card <cms:if logged_in_user_id eq other_user_id>pull-right gxcpl-chat-card-blue<cms:else />pull-left gxcpl-chat-card-green</cms:if>">
						<div class="gxcpl-chat-card-header">
							<cms:related_pages 'user_id'><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></cms:related_pages>
						</div>
						<div class="gxcpl-divider-dark"></div>
						<div class="gxcpl-chat-card-body"><cms:show k_page_title /></div>
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 <cms:if logged_in_user_id eq other_user_id >text-right<cms:else />text-left</cms:if>">
					<small class="text-muted" style="margin: 0px 10px;"><cms:date k_page_date format='d M | H:i' /></small>
				</div>							
			</div>
			<div class="gxcpl-ptop-20"></div>	
		</cms:reverse_related_pages>	
	</cms:related_pages>
</cms:pages>













	<cms:ignore>
	<cms:pages masterpage="chat-messages.php" id="<cms:pages masterpage='select-sos.php' id=sosid_chat><cms:show k_page_id /></cms:pages>" >

		<cms:related_pages 'user_id' >
			<cms:set other_user_id = "<cms:show k_page_id />" scope="global" />
		</cms:related_pages>

		<cms:no_results>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h3 class="text-center text-muted">
					No messages yet!
				</h3>
			</div>
		</div>
		</cms:no_results>

		<cms:reverse_related_pages 'sos_id' masterpage='chat-messages.php'>
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<div class="gxcpl-chat-card <cms:if logged_in_user_id eq other_user_id>pull-right gxcpl-chat-card-blue<cms:else />pull-left gxcpl-chat-card-green</cms:if>">
						<div class="gxcpl-chat-card-header">
							<cms:related_pages 'user_id'><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></cms:related_pages>
						</div>
						<div class="gxcpl-divider-dark"></div>
						<div class="gxcpl-chat-card-body"><cms:show k_page_title /></div>
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 <cms:if logged_in_user_id eq other_user_id >text-right<cms:else />text-left</cms:if>">
					<small class="text-muted" style="margin: 0px 10px;"><cms:date k_page_date format='d M | H:i' /></small>
				</div>							
			</div>
			<div class="gxcpl-ptop-20"></div>
		</cms:reverse_related_pages>
		
	</cms:pages>
	</cms:ignore>

<?php COUCH::invoke(); ?>