<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Dashboard' order='2' >

</cms:template>
	<cms:embed 'header.html' />
	<hr>
	<cms:if k_user_access_level gt '4'>
		<!-- Quick Actions -->
		<div class="container">
			<div class="row">
				<div class="gxcpl-ptop-30"></div>

				<!-- Section Title -->
				<div class="col-md-12">
					<h4 class="gxcpl-no-margin">
						QUICK ACTIONS
						<div class="gxcpl-ptop-10"></div>
						<div class="gxcpl-divider-dark"></div>
						<div class="gxcpl-ptop-20"></div>
					</h4>						
				</div>
				<!-- Section Title -->

				<!-- Blank -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					&nbsp;
				</div>
				<!-- Blank -->

				<!-- SOS -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<center>
						<button class="btn btn-danger gxcpl-fw-700 gxcpl-btn-shadow" onclick="window.location.href='<cms:route_link 'create_sos' masterpage='generate-sos.php' />'" type="button">
							<i class="fa fa-plus"></i> SOS ALERT
						</button>
					</center>
					<div class="gxcpl-ptop-20"></div>
				</div>
				<!-- SOS -->

				<!-- Employee -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<center>
						<a class="btn btn-danger gxcpl-fw-700 gxcpl-btn-shadow" onclick="window.location.href='<cms:link 'users/register.php' />';">
							<i class="fa fa-user-plus"></i> EMPLOYEE
						</a>
					</center>
					<div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Employee -->

				<!-- Helpline -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<center>
						<button class="btn btn-danger gxcpl-fw-700 gxcpl-btn-shadow" onclick="window.location.href='<cms:route_link 'create_help' masterpage='helpline.php' />'" type="button">
							<i class="fa fa-plus"></i> HELPLINE
						</button>
					</center>
					<div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Helpline -->

				<!-- Report -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<center>
						<button class="btn btn-danger gxcpl-fw-700 gxcpl-btn-shadow disabled" type="button">
							<i class="fa fa-plus"></i> REPORT
						</button>
					</center>
					<div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Report -->

				<!-- Blank -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					&nbsp;
				</div>
				<!-- Blank -->

			</div>
		</div>
		<!-- Quick Actions -->

		<!-- Quick View -->
		<div class="container">
			<div class="row">
				<div class="gxcpl-ptop-30"></div>

				<!-- Section Title -->
				<div class="col-md-12">
					<h4 class="gxcpl-no-margin">
						ARMAN STATS: OVERVIEW
						<div class="gxcpl-ptop-10"></div>
						<div class="gxcpl-divider-dark"></div>
						<div class="gxcpl-ptop-20"></div>
					</h4>
				</div>
				<!-- Section Title -->

				<!-- FIR Blank Card -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="gxcpl-dashboard-box-red gxcpl-shadow-1 gxcpl-br-2">
						<h2 class="text-center gxcpl-no-margin">
							FIR
						</h2>
                    </div>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- FIR Blank Card -->

				<!-- FIR Request -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='generate-fir.php' />" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center"><cms:pages masterpage='generate-fir.php' count_only='1' /></h2>
							<div class="text-center">All FIR Request(s)</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- FIR Request -->

				<cms:if k_user_access_level lt '4'>
				<!-- User FIR Request -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='generate-fir.php' />" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center"><cms:pages masterpage='generate-fir.php' custom_field="<cms:if k_user_access_level lt '7'>fir_informer_name=<cms:show k_user_name /></cms:if>" count_only='1' /></h2>
							<div class="text-center">My FIR Request(s)</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- User FIR Request -->
				</cms:if>

				<cms:if k_user_access_level gt '4'>
				<!-- Average FIR Request -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='generate-fir.php' />" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<cms:set total_fir_count="<cms:pages masterpage='generate-fir.php' count_only='1' />" scope="global" />
							<cms:set total_active_emp="<cms:pages masterpage=k_user_template count_only='1' custom_field="extended_user_id > 2 | ipt_emp_registration_ids<>''" />" scope="global" />
							<h2 class="text-center">
								<cms:div total_fir_count total_active_emp /><small> / user</small>
							</h2>
							<div class="text-center">Avg. FIR Requests</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Average FIR Request -->
				</cms:if>
			</div>

			<cms:if k_user_access_level gt '4'>
			<div class="row">
				<!-- SOS Blank Card -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="gxcpl-dashboard-box-red gxcpl-shadow-1 gxcpl-br-2">
						<h2 class="text-center gxcpl-no-margin">
							SOS
						</h2>
                    </div>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- SOS Blank Card -->

				<!-- SOS Generated -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='generate-sos.php' />" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center">
								<cms:pages masterpage='generate-sos.php' count_only='1' />
							</h2>
							<div class="text-center"><cms:if k_user_access_level ge '7'>All </cms:if>SOS Generated</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- SOS Generated -->

				<!-- Average SOS Generated -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='generate-sos.php' />" class="gxcpl-fc-21">
						<cms:set total_sos_generated="<cms:pages masterpage='generate-sos.php' count_only='1' />" scope="global" />
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center">
								<cms:div total_sos_generated total_active_emp /><small> / user</small>
							</h2>
							<div class="text-center">Avg. SOS Generated</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Average SOS Generated -->
			</div>
			</cms:if>

			<div class="row">
				<!-- ALARMS Blank Card -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="gxcpl-dashboard-box-red gxcpl-shadow-1 gxcpl-br-2">
						<h2 class="text-center gxcpl-no-margin">
							ALARMS
						</h2>
                    </div>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- ALARMS Blank Card -->

				<!-- SOS Alerted -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='select-sos.php' />" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center">
								<cms:pages masterpage='select-sos.php' count_only='1' />
							</h2>
							<div class="text-center">Total SOS Alarms</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- SOS Alerted -->

				<!-- Average SOS Alerted -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='select-sos.php' />" class="gxcpl-fc-21">
						<cms:set total_sos_alert_count="<cms:pages masterpage='select-sos.php' count_only='1' custom_field="fir_informer_name_submit=<cms:show k_user_name />" />" scope="global" />
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center">
								<cms:show total_sos_alert_count />
								<cms:ignore>
									<cms:div total_sos_alert_count total_active_emp /><small> / user</small>
								</cms:ignore>
							</h2>
							<div class="text-center">My SOS Alarms</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Average SOS Alerted -->
			</div>

			<cms:if k_user_access_level gt '4'>
			<div class="row">
				<!-- ALARMS Blank Card -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="gxcpl-dashboard-box-red gxcpl-shadow-1 gxcpl-br-2">
						<h2 class="text-center gxcpl-no-margin">
							EMPLOYEE
						</h2>
                    </div>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- ALARMS Blank Card -->

				<!-- Total Employee -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<cms:if k_user_access_level ge '7'><a href="<cms:link masterpage='employee-list.php' />" class="gxcpl-fc-21"></cms:if>
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center"><cms:pages masterpage=k_user_template count_only='1' custom_field="extended_user_id > 2" /></h2>
							<div class="text-center">Total Employee</div>
	                    </div>
	                <cms:if k_user_access_level ge '7'></a></cms:if>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Total Employee -->

				<!-- Activated Employee -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<cms:if k_user_access_level ge '7'><a href="<cms:link masterpage=k_user_template />" class="gxcpl-fc-21"></cms:if>
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center"><cms:show total_active_emp /></h2>
							<div class="text-center">Activated Employee</div>
	                    </div>
	                <cms:if k_user_access_level ge '7'></a></cms:if>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Activated Employee -->
			</div>
			</cms:if>

			<div class="row">
				<!-- Helpline Blank Card -->
				<div class="col-md-2 col-sm-12 col-xs-12">
					<div class="gxcpl-dashboard-box-red gxcpl-shadow-1 gxcpl-br-2">
						<h2 class="text-center gxcpl-no-margin">
							MISC.
						</h2>
                    </div>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Helpline Blank Card -->
				<!-- Helpline Number -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="<cms:link masterpage='helpline.php' />" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center"><cms:pages masterpage="helpline.php" count_only="1" /></h2>
							<div class="text-center">Helpline Number(s)</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Helpline Number -->

				<cms:if k_user_access_level gt '4'>
				<!-- Reports Generated -->
				<div class="col-md-2 col-sm-6 col-xs-6">
					<a href="#!" class="gxcpl-fc-21">
						<div class="gxcpl-dashboard-box gxcpl-shadow-1 gxcpl-br-2 gxcpl-bg-white">
							<h2 class="text-center">0</h2>
							<div class="text-center">Reports Generated</div>
	                    </div>
	                </a>
                    <div class="gxcpl-ptop-20"></div>
				</div>
				<!-- Reports Generated -->
				</cms:if>

			</div>
			<div class="gxcpl-ptop-20"></div>
		</div>
		<!-- Quick View -->
	<cms:else />
		<div class="container">
			<div class="col-md-4 col-md-offset-4">
				<a href="<cms:get_custom_field 'google_play_link' masterpage='globals.php' />" target="_blank" >
					<img src="<cms:show k_site_link />assets/images/google-play-badge.png" style="width: 100%;">
				</a>
				<br>
				<div class="text-center">
					Our app is now available on Google Play.
				</div>
			</div>
		</div>
	</cms:if>
<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>