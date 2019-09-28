<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Chat Messages' clonable='1' parent="_chat_" order='1'>
	<cms:editable name="user_id" type="relation" masterpage="users/index.php" has="one" order="1" />
	<cms:editable name='chatmessage_chat' type='relation' masterpage='chat.php' has='one' />
</cms:template>

<cms:embed 'header.html' />

		<!-- Section Title -->
		<cms:embed 'selectsos-title.html' />
		<!-- Section Title -->

		<!-- Section Divider -->
        <div class="gxcpl-ptop-10"></div>
        <!-- <div class="gxcpl-divider-dark"></div> -->
        <div class="gxcpl-ptop-10"></div>
        <!-- Section Divider -->

        <cms:ignore>
		<!-- 

			23/08/2019
			chat.php shows mesage display

		<div class="container">
			<div class="row">
				<div class="col-md-12 gxcpl-chat-window" id="gxcpl-chat-window">
					<div id="user_details"></div>
				</div>
			</div>
		</div>
		 -->
		</cms:ignore>

		<div class="gxcpl-ptop-10"></div>

		<!-- Form -->
		<div class="container">
			<div class="row">
				<cms:pages masterpage='select-sos.php' rt_id=k_page_id>
			        <cms:related_pages 'selectsos_chat' >
			            <cms:set chat="<cms:show k_page_id />" scope='global' />
			        </cms:related_pages>
			    </cms:pages>
				<!-- <div class="col-md-12"> -->
				<cms:form
			        masterpage=k_template_name
			        mode='create'
			        enctype='multipart/form-data'
			        method='post'
			        anchor='0'
			        id='chat_message_form'
			    >

			        <cms:if k_success >

			            <cms:db_persist_form
			                _invalidate_cache='0'
			                _auto_title='0'
			                k_page_title = "<cms:show frm_k_page_title />"
			                chatmessage_chat="<cms:show chat />"
			                user_id="<cms:show k_user_id />"
			            />
			            <cms:if k_success>
				            <cms:set_flash name='submit_success' value='1' />
				            <cms:redirect k_page_link />
				        </cms:if>
			        </cms:if>				        

	        		<div class="input-group" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
						<cms:input type="bound" class="form-control" name="k_page_title" placeholder="Write your message..." />
						<div class="input-group-btn">
							<button class="btn btn-success" type="submit">
								<i class="fa fa-send"></i> SEND
							</button>
						</div>
					</div>

					<div class="gxcpl-ptop-10"></div>

					
			        <cms:set submit_success="<cms:get_flash 'submit_success' />" />
				    <cms:if submit_success >
				    	<div class="alert alert-success" style="padding: 2px 5px; margin-bottom: 0px;">
				        <strong>Success!</strong> Message sent. (<cms:pages masterpage='chat.php'><cms:related_pages 'chat_sos'><cms:show k_page_id /></cms:related_pages></cms:pages>||<cms:pages masterpage='chat.php'><cms:show k_page_id /></cms:pages>)
					    </div>
					</cms:if>

					<cms:if k_error >
			            <div class="error">
			                <cms:each k_error >
			                    <div class="alert alert-danger" style="padding: 2px 5px; margin-bottom: 0px;">
			                    	<strong>Oops!</strong> Try again.
			                    </div>
			                </cms:each>
			            </div>
			        </cms:if>

			    </cms:form>
				<!-- </div> -->
			</div>
		</div>
		<!-- Form -->

		<!-- Notification -->
		<div class="gxcpl-notify-container">
			<a href="#" class="gxcpl-fc-white">
				<div class="gxcpl-notify gxcpl-shadow-2">
					<i class="fa fa-bell fa-lg"></i>
					<span class="badge gxcpl-badge">0</span> 
				</div>
			</a>
		</div>
		<!-- Notification -->
	<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>