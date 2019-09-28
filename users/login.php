<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Login' parent='_emp_' hidden='1' order='3' />
<cms:embed 'header.html' />		
		<!-- now the real work -->
	    <cms:if k_logged_in >

	        <!-- this 'login' template also handles 'logout' requests. Check if this is so -->
	        <cms:set action="<cms:gpc 'act' method='get'/>" />
	    
	        <cms:if action='logout' >
	            <cms:process_logout />
	        <cms:else />  
	            <!-- what is an already logged-in member doing on the login page? Send back to homepage. -->
	            <cms:redirect k_site_link />
	        </cms:if>
	    
	    <cms:else />
		<!-- Login -->
		<cms:form method="post" anchor='0' name='login'>
			<cms:if k_success >
                <!-- 
                    The 'process_login' tag below expects fields named 
                    'k_user_name', 'k_user_pwd' and (optionally) 'k_user_remember', 'k_cookie_test'
                    in the form
                -->
                <cms:set username="<cms:gpc 'k_user_name' method='get' />" />
				<cms:set password="<cms:gpc 'k_user_pwd' method='get' />" />
				<cms:set cookie="<cms:gpc 'k_cookie_test' method='get' />" />

                <cms:process_login redirect='1' />
                
            </cms:if>
            
            <cms:if k_error >
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
            </cms:if>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="gxcpl-br-2 gxcpl-shadow-2 gxcpl-bg-white">
							<!-- Login Title -->
							<h3 class="gxcpl-no-margin text-center">
								<div class="gxcpl-ptop-10"></div>
								Login
								<div class="gxcpl-ptop-10"></div>
							</h3>
							<!-- Login Title -->
								<!-- Form -->
								
									<!-- Username -->
									<div class="col-md-12">
										<!-- <div class="gxcpl-br-2 gxcpl-shadow-2 gxcpl-bg-white"> -->
											<div class="gxcpl-padding-15">

												<div class="row">
													<!-- Username -->
													<div class="col-md-12">
														<label>Username</label>
														<cms:input name="k_user_name" type="text" class="gxcpl-input-text" aria-describedby="username" />
														<div class="gxcpl-ptop-10"></div>
													</div>
													<!-- Username -->
													<!-- Password -->
													<div class="col-md-12">
														<label>Password</label>
														<cms:input name="k_user_pwd" type="password" class="gxcpl-input-text" placeholder="" aria-describedby="password" />
														<div class="gxcpl-ptop-10"></div>
													</div>
													<!-- Password -->
												</div>
											</div>
										<!-- </div> -->
									</div>

									<input type="hidden" name="k_cookie_test" value="1" />

									<center>
										<button type="submit" class="btn btn-danger btn-sm gxcpl-fw-700 gxcpl-shadow-2">
											<i class="fa fa-sign-in"></i> LOGIN
										</button>
									</center>
									<div class="gxcpl-ptop-10"></div>
									<div class="gxcpl-ptop-5"></div>
								
								<!-- Form -->

							<!-- 
							<cms:ignore>
							<div class="text-center">
								Forgot Password? <a href="<cms:link k_user_lost_password_template />">Click here</a>
							</div> 
							</cms:ignore>
							-->
							<div class="gxcpl-ptop-10"></div>
							<div class="gxcpl-ptop-5"></div>
						</div>
					</div>
				</div>
			</div>
		</cms:form>
		</cms:if>
		<!-- Login -->
		<div class="gxcpl-ptop-50"></div>
	<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>