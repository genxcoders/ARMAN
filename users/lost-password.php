<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Lost Password' hidden='1' parent='_emp_' order='4' />
<cms:embed 'header.html' />

    <cms:if k_logged_in >
        <!-- what is an already logged-in member doing on this page? Send back to homepage. -->
        <cms:redirect k_site_link />
    </cms:if>

    <cms:set success_msg="<cms:get_flash 'success_msg' />" />
    <cms:if success_msg >
        <div class="notice">
            <cms:if success_msg='1' >
                A confirmation email has been sent to you<br />
                Please check your email.
            <cms:else />
                Your password has been reset<br />
				Please check your email for the new password.
            </cms:if>
        </div>
    <cms:else />
        
        <!-- now the real work -->
        <cms:set action="<cms:gpc 'act' method='get'/>" />
        
        <!-- is the visitor here by clicking the reset-password link we emailed? -->
        <cms:if action='reset' >
            <h1>Reset Password</h1>
        
            <cms:process_reset_password />
            
            <cms:if k_success >
                 <cms:set_flash name='success_msg' value='2' />
                 <cms:redirect k_page_link />          
            <cms:else />
                <div class="container">
	            	<div class="row">
	            		<div class="col-md-4 col-md-offset-4">
		                    <div class="alert alert-danger gxcpl-shadow-2">
		                    	<strong>Oops!</strong> <cms:show k_error />
		                    </div>
		                </div>
	                </div>
	            </div>
            </cms:if>
        
        <cms:else />
		
		<cms:form method="post" anchor='0'>
            <cms:if k_success>
            
                <!-- the 'process_forgot_password' tag below expects a field named 'k_user_name' -->
                <cms:process_forgot_password />
                
                <cms:if k_success>
                    <cms:set_flash name='success_msg' value='1' />
                    <cms:redirect k_page_link /> 
                </cms:if>    
            </cms:if>
            
            <cms:if k_error >
            	<div class="container">
	            	<div class="row">
	            		<div class="col-md-4 col-md-offset-4">
		                    <div class="alert alert-danger gxcpl-shadow-2">
		                    	<strong>Oops!</strong> <cms:show k_error />
		                    </div>
		                </div>
	                </div>
	            </div>
            </cms:if>
			<!-- Forgot Password -->
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="gxcpl-br-2 gxcpl-shadow-2 gxcpl-bg-white">
							<!-- Forgot Password Title -->
							<h3 class="gxcpl-no-margin text-center">
								<div class="gxcpl-ptop-10"></div>
								Forgot Password
								<div class="gxcpl-ptop-10"></div>
							</h3>
							<!-- Forgot Password Title -->

							<!-- Form -->
							
								<!-- Username -->
								<div class="col-md-12">
									<div class="gxcpl-padding-15">

										<div class="row">
											<!-- Username -->
											<div class="col-md-12">
												<label>Username</label>
												<cms:input name="k_user_name" type="text" class="gxcpl-input-text" />
												<div class="gxcpl-ptop-10"></div>
											</div>
											<!-- Username -->
										</div>
									</div>
								</div>
								<center>
									<button type="submit" class="btn btn-danger btn-sm gxcpl-fw-700 gxcpl-shadow-2">
										<i class="fa fa-power-off"></i> RESET PASSWORD
									</button>
								</center>
								<div class="gxcpl-ptop-10"></div>
								<div class="gxcpl-ptop-5"></div>
							</cms:form>
							<!-- Form -->

							<div class="text-center">
								Already Register? <a href="<cms:login_link />">Click here</a>
							</div>
							<div class="gxcpl-ptop-10"></div>
							<div class="gxcpl-ptop-5"></div>
						</div>
					</div>
				</div>
			<!-- Forgot Password -->
		</cms:if>
	</cms:if>
	<div class="gxcpl-ptop-50"></div>
	<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>