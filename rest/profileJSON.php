<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='All SOS - List' order='1001' parent='_rest_json_' />
<cms:set userid="<cms:gpc 'userid' method='get' />" />
<cms:content_type 'application/json'/>
<cms:if k_logged_in>
{
	"profileJSON":
	{
	    "status": "SUCCESS",
        "message": "Logged in user details",
        "data": [
    	    <cms:pages masterpage=k_user_template id=k_user_id limit='1' >
    	    {
                "status_code":"200",
                "message":"Login Successful",
                "data":
                {
                    "user":
                    {
                        <cms:pages masterpage=k_user_template show_future_entries='1' custom_field="extended_user_id=<cms:show user_id />" >
                        "userid":"<cms:show extended_user_id />",
                        "userdp":"<cms:addslashes><cms:show_securefile 'ipt_emp_photo'><cms:if file_is_image ><cms:securefile_link file_id /></cms:if></cms:show_securefile></cms:addslashes>",
                        "email":"<cms:addslashes><cms:show extended_user_email /></cms:addslashes>",
                        "fname":"<cms:addslashes><cms:show ipt_emp_fname /></cms:addslashes>",
                        "lname":"<cms:addslashes><cms:show ipt_emp_lname /></cms:addslashes>",
                        "designation":"<cms:addslashes><cms:related_pages 'ipt_emp_designation'><cms:show k_page_title /></cms:related_pages></cms:addslashes>",
                        "department":"<cms:addslashes><cms:related_pages 'ipt_emp_department'><cms:show k_page_title /></cms:related_pages></cms:addslashes>",
                        "mobilenumber":"<cms:addslashes><cms:show ipt_emp_mobile_number /></cms:addslashes>",
                        "dob":"<cms:addslashes><cms:date ipt_emp_dob format='M d, Y' /></cms:addslashes>"
                        </cms:pages>
                    }   
                }
            }
	        </cms:pages>
	    ]
	}
}
<cms:else />
{
    "profileJSON":
    {
        "status": "FAILURE",
        "message": "User not logged in!",
        "data": {}
    }
}
</cms:if>
<?php COUCH::invoke(); ?>