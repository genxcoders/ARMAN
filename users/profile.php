<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='User Profile' hidden='1' parent='_emp_' order='5' />
<cms:embed 'header.html' />
			<!-- Register -->
			<div class="container">

			    <cms:form 
			        masterpage=k_user_template 
			        mode='edit'
			        page_id=k_user_id
			        enctype="multipart/form-data"
			        method='post'
			        anchor='0'
			    >
			        
			        <cms:if k_success >
			            <cms:db_persist_form 
			            	ipt_psw = "<cms:show frm_extended_user_password />"
			            />

			            <cms:if k_success >
			                <cms:set_flash name='success_msg' value='1' />
			                <cms:redirect k_page_link /> 
			            </cms:if>
			        </cms:if>  
			        
			        <cms:if k_error >
			        	<div class="row">
			        		<div class="col-md-12">
			        			<div class="alert alert-danger">
			        				<cms:each k_error >
						            <cms:show item /><br />
						        	</cms:each>
			        			</div>
			        		</div>
			        	</div>
			        </cms:if>

					<div class="row">
						<div class="gxcpl-ptop-30"></div>

						<!-- Section Title -->
						<div class="col-md-12">
							<h4 class="gxcpl-no-margin">
								UPDATE PROFILE
								<div class="gxcpl-ptop-10"></div>
								<div class="gxcpl-divider-dark"></div>
								<div class="gxcpl-ptop-20"></div>
							</h4>
						</div>
						<!-- Section Title -->

						<!-- Section Divider -->
						<div class="gxcpl-ptop-10"></div>
						<!-- <div class="gxcpl-divider-dark"></div> -->
						<!-- Success Message -->
						<cms:set success_msg="<cms:get_flash 'success_msg' />" />
					    <cms:if success_msg >
					    	<div class="row">
					    		<div class="col-md-12">
					    			<div class="alert alert-success">
						    			<strong>Success! </strong>Profile updated successfully.
						    		</div>
					    		</div>
					    	</div>
					    </cms:if>
					    <!-- Success Message -->
						<div class="gxcpl-ptop-10"></div>
						<!-- Section Divider -->

						<!-- Form -->
						<div class="col-md-3">
							<!-- Upload Image -->
							<cms:pages masterpage='users/index.php' id=k_user_id>
							<cms:if ipt_emp_photo>
                				<cms:show_securefile 'ipt_emp_photo' >
									<cms:if file_is_image >
										<img id="upload_img" class="gxcpl-passport-photo" src="<cms:securefile_link file_id /> " style="width: 100px;"/>
									</cms:if>
								</cms:show_securefile>
								<div class="gxcpl-ptop-20"></div>
								
								<cms:input id="upload_img" name="ipt_emp_photo" onchange="readURL(this);" type="bound" />
							<cms:else />
								<img id="upload_img" src="<cms:show k_site_link />assets/images/crentral-railway-user-no-photo-genxcoders-pvt-ltd-gxcpl.png" alt="your image" class="gxcpl-passport-photo"style="width: 100px;" />
						    	<div class="gxcpl-ptop-20"></div>
						    	<input id="upload_img" name="f_ipt_emp_photo" onchange="readURL(this);" type="file" />
						    	<cms:hide>
									<cms:input name="ipt_emp_photo" type="bound" />
								</cms:hide>
							</cms:if>
							</cms:pages>
							<!-- Upload Image -->
							<div class="gxcpl-ptop-30"></div>
						</div>
						<div class="col-md-9">
							<div class="gxcpl-shadow-2 gxcpl-br-2 gxcpl-bg-white">
								<div class="gxcpl-padding-15">
									<div class="row">
										<!-- First Name -->
										<div class="col-md-6">
											<label>First Name</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_fname" type='bound' value="<cms:show ipt_emp_fname />" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- First Name -->
										<!-- Last Name -->
										<div class="col-md-6">
											<label>Last Name</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_lname" type='bound' />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Last Name -->

										<!-- Email -->
										<div class="col-md-6">
											<label>Email</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="extended_user_email" type='bound' />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Email -->
										<!-- Mobile Number -->
										<div class="col-md-6">
											<label>Mobile Number</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_mobile_number" type='bound' />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Mobile Number -->
										<!-- Designation -->
										<div class="col-md-6">
											<label>Designation</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_designation" type='bound' />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Designation -->
										<!-- Department -->
										<div class="col-md-6">
											<label>Department</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_department" type='bound' />
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
										<div class="col-md-6">
											<label>Registration Id</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="ipt_emp_registration_ids" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Registration Id -->
									</div>
								</div>
								<div class="gxcpl-divider-dark"></div>
								<div class="gxcpl-ptop-20"></div>
								<div class="row gxcpl-fc-light-red text-center">
									<!-- Message for editing password -->
									<small><strong>Enter values in <em>Password</em> and <em>Repeat Password</em> fields only is you want to change the password.</strong></small>
									<!-- Message for editing password -->
								</div>
								<div class="gxcpl-padding-15">
									<div class="row">
										<!-- Password -->
										<div class="col-md-6">
											<label>Password</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="extended_user_password" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Password -->
										<!-- Repeat Password -->
										<div class="col-md-6">
											<label>Repeat Password</label>
											<div class="gxcpl-ptop-5"></div>
											<cms:input class="gxcpl-input-text" name="extended_user_password_repeat" type="bound" />
											<div class="gxcpl-ptop-10"></div>
										</div>
										<!-- Repeat Password -->
									</div>
								</div>
								<div class="gxcpl-divider-dark"></div>
								<div class="gxcpl-ptop-10"></div>
								<div class="row">
									<div class="col-md-12">
										<center>
											<button type="submit" class="btn btn-danger btn-sm gxcpl-fw-700">
												<i class="fa fa-save"></i> UPDATE PROFILE
											</button>
										</center>
										<div class="gxcpl-ptop-10"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- Form -->
					</div>
				</cms:form>
			</div>
			<!-- Register -->

			<!-- <div class="gxcpl-ptop-50"></div> -->
	<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>		