<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Chat Module' clonable='1'>
	<cms:editable name="user_id" type="relation" masterpage="users/index.php" has="one" order="1" />
	<cms:editable name='chat_message' type='text' required='1' order='2' />
</cms:template>

<cms:if k_logged_out >
    <cms:redirect "<cms:login_link />" />
</cms:if>

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="shortcut icon" type="image/png" href="<cms:get_custom_field 'sb_favicon' masterpage='globals.php' />" />
		<link rel="stylesheet" type="text/css" href="<cms:show k_site_link />assets/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<cms:show k_site_link />assets/css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="<cms:show k_site_link />assets/css/gxcpl-dma.css" />
	</head>
	<body style="margin-top: 10px;">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h4>O/P</h4>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 gxcpl-chat-window" id="gxcpl-chat-window">
					<cms:if k_logged_in >
					    <cms:pages masterpage=k_user_template id=k_user_id limit='1'>
					        <cms:set logged_in_user_id = "<cms:show k_page_id />" scope="global" />
					    </cms:pages>
					</cms:if>

					<cms:pages masterpage=k_template_name show_future_entries='1' skip_custom_fields='1' order='asc' >
					<cms:no_results>
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<h3 class="text-center text-muted">
								No messages yet!
							</h3>
						</div>
					</div>
					</cms:no_results>
					
					<cms:related_pages 'user_id' >
						<cms:set other_user_id = "<cms:show k_page_id />" scope="global" />
					</cms:related_pages>					
					
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="gxcpl-chat-card <cms:if logged_in_user_id eq other_user_id >pull-right gxcpl-chat-card-blue<cms:else />pull-left gxcpl-chat-card-green</cms:if>">
								<div class="gxcpl-chat-card-header" id="chat_user_name"><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></div>
								<div class="gxcpl-divider-dark"></div>
								<div class="gxcpl-chat-card-body" id="chat_msg"><cms:show k_page_title /></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 <cms:if logged_in_user_id eq other_user_id >text-right<cms:else />text-left</cms:if>">
							<small class="text-muted" id="message_date"></small>
						</div>							
					</div>
					<div class="gxcpl-ptop-20"></div>
					</cms:pages>
				
				</div>
			</div>
		</div>

		<div class="gxcpl-ptop-10"></div>

		<!-- Form -->
		<div class="container">
			<div class="row">
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
			                _auto_title='1'
			                k_page_title = "<cms:show frm_chat_message />"
			                user_id="<cms:show k_user_id />"
			            />
			            <cms:if k_success>
				            <cms:set_flash name='submit_success' value='1' />
				            <cms:redirect k_page_link />
				        </cms:if>
			        </cms:if>				        

	        		<div class="input-group" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
						<cms:input type="bound" class="form-control" name="chat_message" placeholder="Write your message..." autofocus="autofocus" />
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
				        <strong>Success!</strong> Message sent.
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

		<script type="text/javascript" src="<cms:show k_site_link />assets/js/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="<cms:show k_site_link />assets/js/bootstrap.js"></script>

		<script type="text/javascript">
			// Keep Chat window to bottom
			var element = document.getElementById("gxcpl-chat-window");
			element.scrollTop = element.scrollHeight;

			// Save form using ajax
			$(function () {
				$('form').on('submit', function (e) {
					e.preventDefault();
					$.ajax({
						type: 'post',
						url: '<cms:show k_site_link />chat.php',
						data: $('form').serialize(),
						success: function () {
							document.getElementById("chat_message_form").reset();
							//alert('form was submitted');
						}
					});
				});
			});
			
			function loadLog(){
			$.ajax({
        		type: 'get',
		        url: '<cms:show k_site_link />chat-json.php',
		        //data: $('#cityDetails').serialize(),
		        dataType:"json", //to parse string into JSON object,
		        // success: function(data){ 
		        //     if(data){
		        //         var len = data.messages.length;
		        //         var txt = "";
		        //         if(len > 0){
		        //             for(var i=0;i<len;i++){
		        //                 if(data.messages[i].username && data.messages[i].message){
		        //                     txt += "<tr><td>"+data.messages[i].username+"</td><td>"+data.messages[i].message+"</td></tr>";
		        //                 }
		        //             }
		        //             if(txt != ""){
		        //                 $("#table").append(txt).removeClass("hidden");
		        //             }
		        //         }
		        //     }
		        // },
		        // error: function(jqXHR, textStatus, errorThrown){
		        //     alert('error: ' + textStatus + ': ' + errorThrown);
		        // }
		    });
		    // return false;
			}

			var previous = null;
    		var current = null;
			setInterval (function() {
				$.getJSON("<cms:show k_site_link />chat-json.php", function(loadLog) {
		            current = JSON.stringify(loadLog);            
		            if (previous && current && previous !== current) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous = current;
		        });     
			}, 2000);
		</script>
	</body>
</html>
<?php COUCH::invoke(); ?>