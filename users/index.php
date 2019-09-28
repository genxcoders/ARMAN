<?php require_once( '../couch/cms.php' ); ?>

<cms:template clonable='1' title='Users' hidden='1' parent="_emp_" order='1' dynamic_folders='1' folder_masterpage='department.php'>
    <!-- If additional fields are required for users, they can be defined here in the usual manner.--> 
    <cms:editable name='ipt_emp_photo' label='Upload Image' type='securefile' order='1'/>      
    <cms:editable name='ipt_emp_fname' label='First Name' type='text' required='1' order='2' />
    <cms:editable name='ipt_emp_lname' label='Last Name' type='text' required='1' order='3' />  
    <cms:editable name='ipt_emp_mobile_number' label='Mobile Number' required='1' type='text' validator='exact_len=10 | non_negative_integer' order='4' />
    <cms:editable name='ipt_emp_designation' label='Designation' type='relation' masterpage='designation.php' has='one' order='5' required='1' css='assets/css/gxcpl-dma.css' />
    <cms:ignore>
    <cms:editable name='ipt_emp_department' label='Department' type='relation' masterpage='department.php' has='one' order='6' required='1' />
    </cms:ignore>
    <cms:editable name='ipt_emp_dob' label='User Date of Birth' type='datetime' order='7' />
    <cms:editable name='ipt_emp_registration_ids' label='Registration Ids' type='text' order='8' />
    <cms:editable name='ipt_psw' label='Password' type='text' order='9' />
    <cms:editable name='ipt_pf_num' label='PF Number' type='text' order='10' />

    <cms:config_list_view>
        <cms:field 'k_selector_checkbox' />
        <cms:field 'ipt_emp_fname' header='First Name' />
        <cms:field 'ipt_emp_lname' header='Last Name' />
        <cms:field 'extended_user_email' header='Email' />
        <cms:field 'ipt_emp_mobile_number' header='Mobile' />
        <cms:field 'ipt_emp_designation' header='Designation' />
        <cms:field 'ipt_emp_department' header='Department' />
        <cms:field 'k_page_date' header='Reg. Date' />
        <cms:field 'k_actions' />
    </cms:config_list_view>
</cms:template>

<cms:embed 'header.html' />
    <!-- List SOS -->
            <div class="container">
                <div class="row">
                    <div class="gxcpl-ptop-30"></div>

                    <!-- Section Title -->
                    <div class="col-md-12">
                        <h4 class="gxcpl-no-margin">
                            EMPLYOEE LIST <cms:if k_user_access_level gt '7'><small class="pull-right gxcpl-fw-500" style="height: 21px; line-height: 21px;"><button class="btn btn-danger btn-xs gxcpl-shadow-2 gxcpl-fw-700" type="button" style="margin-left: 30px;" onclick="window.location.href='<cms:link k_user_registration_template />';"><i class="fa fa-plus"></i> ADD EMPLYOEE</button> </small></cms:if>
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

                    <!-- Table -->
                    <div class="col-md-12">
                        <div class="gxcpl-br-2 gxcpl-shadow-2 gxcpl-bg-white">
                            
                                <table class="gxcpl-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Sr. No.
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Designation
                                            </th>
                                            <th>
                                                Department
                                            </th>
                                            <cms:if k_user_access_level gt '7'>
                                            <th>
                                                Mobile
                                            </th>
                                            </cms:if>
                                            <th class="text-center">
                                                Status
                                            </th>
                                            <!-- 
                                            Uncomment on when action is activated
                                            <cms:ignore>
                                            <cms:if k_user_access_level gt '7'>
                                            <th class="text-center">
                                                Actions
                                            </th>
                                            </cms:if>
                                            </cms:ignore> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <cms:pages masterpage=k_user_template id=extended_user_id show_future_entries='1' paginate='1' limit='25' >
                                        <cms:no_results>
                                        <tr>
                                            <!-- 
                                            Uncomment when Action is uncommented
                                            <cms:ignore>
                                            <cms:if k_user_access_level gt '7'>
                                            <td colspan='7' class="text-center">
                                                - No Result -
                                            </td>
                                            <cms:else />
                                            <td colspan='6' class="text-center">
                                                - No Result -
                                            </td>
                                            </cms:if>
                                            </cms:ignore> -->
                                            <!-- Remove when above code in uncommented -->
                                            <cms:if k_user_access_level gt '7'>
                                                <td colspan='6' class="text-center">
                                                    - No Result -
                                                </td>
                                            <cms:else />
                                                <td colspan='5' class="text-center">
                                                    - No Result -
                                                </td>
                                            </cms:if>
                                            <!-- Remove when above code in uncommented -->
                                        </tr>
                                        </cms:no_results>

                                        <!-- To hide super admin -->
                                        <cms:if extended_user_id eq '1'>
                                        <cms:else />
                                        <tr>
                                            <td class="text-center">
                                                <cms:show k_current_record />
                                            </td>
                                            <td>
                                                <cms:show ipt_emp_fname /> <cms:show ipt_emp_lname />
                                            </td>
                                            <td>
                                                <cms:related_pages 'ipt_emp_designation' >
                                                <cms:show k_page_title />
                                                </cms:related_pages>
                                            </td>
                                            <td>
                                                <cms:related_pages 'ipt_emp_department' >
                                                <cms:show k_page_title />
                                                </cms:related_pages>
                                            </td>
                                            <cms:if k_user_access_level gt '7' >
                                            <td>
                                                <cms:show ipt_emp_mobile_number />
                                            </td>
                                            </cms:if>
                                            <td class="text-center">
                                                <cms:if ipt_emp_registration_ids != ''>
                                                    <p class="gxcpl-dot-green" style="display: inline-block; margin-bottom: 0;"></p>
                                                <cms:else_if ipt_emp_registration_ids == '' />
                                                    <p class="gxcpl-dot-red" style="display: inline-block; margin-bottom: 0;"></p>
                                                </cms:if>
                                            </td>
                                            <!-- 
                                            Uncomment for activating action
                                            <cms:ignore>
                                            <cms:if k_user_access_level gt '7'>
                                            <td class="text-center">
                                                <a href="<cms:show k_page_link />" class="btn btn-success btn-xs gxcpl-fw-700" data-toggle="tooltip" data-placement="top" title="VIEW">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="<cms:link 'users/employee-edit.php' />?id=<cms:show k_page_id />" class="btn btn-primary btn-xs gxcpl-fw-700" data-toggle="tooltip" data-placement="top" title="EDIT">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="sos-details.html" class="btn btn-danger btn-xs gxcpl-fw-700" data-toggle="tooltip" data-placement="top" title="DELETE">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            </cms:if>
                                            </cms:ignore> -->
                                        </tr>
                                         <!-- To hide super admin -->
                                        </cms:if>
                                        
                                        </cms:pages>
                                    </tbody>
                                </table>
                            
                            <center>
                                <cms:pages masterpage=k_user_template id=extended_user_id show_future_entries='1' paginate='1' limit='25'>
                                    <cms:paginator />
                                </cms:pages>
                            </center>
                            <div class="gxcpl-ptop-10"></div>
                        </div>
                    </div>
                    <!-- Table -->

                </div>
                <div class="gxcpl-ptop-20"></div>
            </div>
            <!-- List SOS -->

        </div>
        <!-- Site Container -->
<cms:embed 'footer.html' />
<?php COUCH::invoke(); ?>