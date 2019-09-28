<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Chat Module' clonable='1' parent="_chat_" order='1'>
	<cms:ignore>

	23/08/2019
	chat.php promoted to be used as chat folder format

	<cms:editable name="user_id" type="relation" masterpage="users/index.php" has="one" order="1" />
	<cms:editable name='chat_message' type='text' order='3' />	
	<cms:editable name="chat_sos" type="relation" masterpage="select-sos.php" has="one" reverse_has="one" order="2" />
</cms:ignore>
</cms:template>
<!-- 
	<cms:ignore>
	23/08/2019
	
	Content moved to chat-messages.php

	Because chat.php promoted to be used as chat folder format
	</cms:ignore>
 -->

 <cms:embed 'header.html' />

	<!-- Section Title -->
	<cms:embed 'selectsos-title.html' />
	<!-- Section Title -->

	<!-- Section Divider -->
    <div class="gxcpl-ptop-10"></div>
    <!-- <div class="gxcpl-divider-dark"></div> -->
    <div class="gxcpl-ptop-10"></div>
    <!-- Section Divider -->

	<div class="container">
		<div class="row">
			<div class="col-md-12 gxcpl-chat-window" id="gxcpl-chat-window">
				<div id="user_details"></div>
			</div>
		</div>
	</div>

	<div class="gxcpl-ptop-10"></div>

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