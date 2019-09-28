<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Registration' hidden='1' parent="_emp_" order='2' />
<cms:embed 'header.html' />
			<!-- Register -->
			<div class="container">
				<div class="row">
					<div class="gxcpl-ptop-30"></div>

					<!-- Section Title -->
					<div class="col-md-12">
						<h4 class="gxcpl-no-margin">
							ADD EMPLOYEE
							<div class="gxcpl-ptop-10"></div>
							<div class="gxcpl-divider-dark"></div>
							<div class="gxcpl-ptop-20"></div>
						</h4>
					</div>
					<!-- Section Title -->

					<!-- Section Divider -->
					<div class="gxcpl-ptop-10"></div>
					<!-- <div class="gxcpl-divider-dark"></div> -->
					<div class="gxcpl-ptop-10"></div>
					<!-- Section Divider -->
					
				    <cms:set success_msg="<cms:get_flash 'success_msg' />" />
				    <cms:if success_msg >
				    	<div class="col-md-12 text-center">
							<div class="alert alert-success gxcpl-shadow-1">
								<strong>Success!</strong> Account has been created successfully and we have sent an email to the registered email id with the employee username and password.
							</div>
							<div class="gxcpl-ptop-20"></div>
						</div>
				    </cms:if>
					<!-- Form -->
					<cms:form 
		                masterpage=k_user_template 
		                mode='create'
		                enctype='multipart/form-data'
		                method='post'
		                anchor='0'
		                >

		                <cms:if k_success >        

		                    <cms:check_spam email=frm_extended_user_email />            

		                    <cms:db_persist_form 
		                        _invalidate_cache='0'
		                        k_page_title = "<cms:show frm_ipt_emp_fname />_<cms:show frm_ipt_emp_lname />"
		                        k_page_name = "<cms:show frm_ipt_pf_num />"
		                        ipt_psw = "<cms:show frm_extended_user_password />"
		                    />                    

		                    <cms:if k_success >
		                        <cms:send_mail from="<cms:php>echo K_EMAIL_FROM;</cms:php>" to=frm_extended_user_email subject='New Account Confirmation' debug='0' html='1'>
		                           	<!DOCTYPE html>
									<html>
										<head>
											<meta charset="UTF-8">
											<meta name="description" content="Free Web tutorials">
											<meta name="keywords" content="HTML,CSS,XML,JavaScript">
											<meta name="author" content="John Doe">
											<meta name="viewport" content="width=device-width, initial-scale=1.0">
											<title>DMA: Page Title</title>
											<!-- CSS -->
											<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
											<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
											<!-- CSS -->
											<style type="text/css">
												html {
													min-height: 100%;
												}			
												body {
													padding: 0;
													font-family: 'Raleway', sans-serif;
													background-color: rgba(0,0,0,0.08);
													font-size: 13px;
													color: #212121;
													width: 95%;
													/*overflow: hidden;*/
													margin: auto;
													display: block;				
												}
											</style>
										</head>
										<body>
											<div style="width: 90%; min-height: 570px; height: auto; border-radius: 2px; background-color: #ffffff; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); margin: 30px auto; display: block; padding: 5px 10px;">
												<img src="<cms:show k_site_link />assets/images/Railway.png" style="margin: 10px auto 20px auto; display: block; width: 100px;" />
												<h3 style="text-align: center; margin: 0px;">
													<small>ARMAN</small><br/>
													Accident Report and Management Application
												</h3>
												<div style="text-align: justify; padding-top: 30px;">
													<cms:pages masterpage="users/index.php" limit="1" >
													<strong>Dear <cms:show ipt_emp_fname /> <cms:show ipt_emp_lname />,</strong><br><br/>
													Your account has been successfully created on <strong>ARMAN Accident Report and Management Application</strong>. According to the information available with us, your registered mobile number is <strong><cms:show ipt_emp_mobile_number /></strong> and email id <strong><cms:show extended_user_email /></strong>.<br><br/>
													Your username and password is as given below.<br>
													<div style="text-align: center;">
														<strong>Username:</strong><cms:show extended_user_email /><br>
														<strong>Password:</strong><cms:show  extended_user_password /><br>
													</div>
													<br />
													</cms:pages>
													Welcome to the ARMAN.
													<br/>
													<br/>
													To download this official application click the <em>Play Store</em> logo below
													<br />
													<br />
													<a href="#!">
														<img src="<cms:show k_site_link />assets/images/Central-Railway-googleplay-genxcoders-pvt-ltd-gxcpl.png" style="width: 200px; margin: auto; display: block; z-index: 9999;" />
													</a>
													<br>
													<small><div style="text-align: center;"><em>Secured email service provided by <strong><a style="color: #212121" target="_blank" href="https://www.gxcpl.com">GenXCoders Pvt Ltd</a></strong></em></div></small>
												</div>
											</div>		
											
											<script type="text/javascript" src="<cms:show k_site_link />assets/js/jquery-1.11.1.js"></script>
											<script type="text/javascript" src="<cms:show k_site_link />assets/js/bootstrap.js"></script>
											
										</body>
									</html>
		                        </cms:send_mail> 
		                        <cms:ignore>  
		                        <cms:send_mail from="<cms:php>echo K_EMAIL_FROM;</cms:php>" to=frm_extended_user_email subject='New Account Confirmation' debug='1'>
		                            Welcome!
		                            <br>
									Your username is: "<cms:show frm_extended_user_email />"<br>
									Your password is: "<cms:show frm_extended_user_password />"<br>

									If you have questions or if you need further information please do not hesitate to contact us at any time!<br>

									Your Team
									<cms:show k_site_link />
		                        </cms:send_mail>
		                        </cms:ignore>                        
		                        <cms:if k_success >                 
		                        	<cms:set_flash name='success_msg' value='1' />
		                        	<cms:redirect k_page_link />
		                        </cms:if>
		                    </cms:if> 
		                </cms:if>
		                <cms:if k_error >
		                	<div class="row">
				                <cms:each k_error >
					                <div class="col-md-6 text-center">
										<div class="alert alert-danger gxcpl-shadow-1">
											<cms:show item />
										</div>
										<div class="gxcpl-ptop-20"></div>
									</div>
								</cms:each>
							</div>
						</cms:if>

						<div class="col-md-3">
							<!-- Upload Image -->
							<img id="upload_img" src="<cms:show k_site_link />assets/images/crentral-railway-user-no-photo-genxcoders-pvt-ltd-gxcpl.png" alt="your image" class="gxcpl-passport-photo"style="width: 100px;" />
						    <div class="gxcpl-ptop-20"></div>
						    <cms:input id="upload_img" name="ipt_emp_photo" onchange="readURL(this);" type="bound" />
							<!-- Upload Image -->
						</div>

						<div class="col-md-9">
							<div class="gxcpl-shadow-2 gxcpl-br-2 gxcpl-bg-white">
								<div class="gxcpl-padding-15">
									<div class="row">
										<!-- First Name -->
										<div class="col-md-6">
											<label>First Name <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_fname" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- First Name -->
										<!-- Last Name -->
										<div class="col-md-6">
											<label>Last Name <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_lname" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Last Name -->

										<!-- Email -->
										<div class="col-md-6">
											<label>Email <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="extended_user_email" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Email -->

										<!-- PF Number -->
										<div class="col-md-6">
											<label>PF Number <span class="gxcpl-required">*</span> <small>(used as user name to login)</small></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_pf_num" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- PF Number -->

										<!-- Mobile Number -->
										<div class="col-md-6">
											<label>Mobile Number <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_mobile_number" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Mobile Number -->
										<!-- Designation -->
										<cms:ignore>
										<!-- <div class="col-md-6">
											<label>Designation <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:hide>
												<cms:input type="bound" name="ipt_emp_designation" />
											</cms:hide>
											<select class="ipt_emp_designation" name="f_ipt_emp_designation">
												<option selected disabled>Select Designation</option>
												<cms:pages masterpage='designation.php' order='asc' orderby='ipt_emp_designation'>
												<option value="<cms:show k_page_id />"><cms:show k_page_title /></option>
												</cms:pages>
											</select>
											<div class="gxcpl-ptop-10"></div>
										</div> -->
										</cms:ignore>
										<!-- Designation -->
										<!-- Designation -->
										<div class="col-md-6">
											<label>Designation <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											
												<cms:input type="bound" name="ipt_emp_designation" order='asc' />
											
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Designation -->
										<!-- Department -->
										<div class="col-md-6">
											<label>Department <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:hide>
												<cms:input type="bound" name="ipt_emp_department" />
											</cms:hide>
											<select class="ipt_emp_department" name="f_ipt_emp_department">
												<option selected disabled>Select Department</option>
												<cms:pages masterpage='department.php' order='asc' orderby='ipt_emp_department'>
												<option value="<cms:show k_page_id />"><cms:show k_page_title /></option>
												</cms:pages>
											</select>
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Department -->
										<!-- DOB -->
										<div class="col-md-6">
											<label>Date of Birth</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_dob" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- DOB -->
										<!-- Registration Id -->
										<cms:ignore>
										<!-- 
										<div class="col-md-6">
											<label>Registration Id</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_registration_ids" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										 -->
										</cms:ignore>
										<!-- Registration Id -->
									</div>
									<div class="row">
										<!-- Password -->
										<div class="col-md-6">
											<label>New Password <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="extended_user_password" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Password -->
										<!-- Repeat Password -->
										<div class="col-md-6">
											<label>Repeat New Password <span class="gxcpl-required">*</span></label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="extended_user_password_repeat" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Repeat Password -->
									</div>
								</div>

								<div class="gxcpl-ptop-10"></div>
								<div class="gxcpl-divider-dark "></div>
								<div class="gxcpl-ptop-10"></div>
								
								<div class="row">
									<div class="col-md-12">
										<center>
											<button type="submit" class="btn btn-danger btn-sm gxcpl-fw-700">
												<i class="fa fa-plus"></i> ADD EMPLOYEE
											</button>
										</center>
										<div class="gxcpl-ptop-10"></div>
									</div>
								</div>
							</div>
						</div>
					</cms:form>
					<!-- From -->
				</div>
				<div class="gxcpl-ptop-50"></div>
			</div>
			<!-- Register -->
		</div>
		
	<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>