<?php require_once( '../couch/cms.php' ); ?>
<?php require_once( '../rest/loginClass.php' ); ?>

<cms:template title='Receive Profile'/>

<cms:set hashToken_url="<cms:gpc 'hashTokencheck' method='get' />" scope="global" />
<cms:set userid="<cms:gpc 'userid' method='get' />" scope="global" />
<cms:set ipt_emp_fname="<cms:gpc 'fname' method='get' />" scope='global' /> 
<cms:set ipt_emp_lname="<cms:gpc 'lname' method='get' />" scope='global' />
<cms:set ipt_emp_mobile_number="<cms:gpc 'mobile' method='get' />" scope='global' /> 

<cms:content_type 'application/json'/>
<cms:if hashToken_url ne "" >
    <cms:if userid ne "">
        <cms:query sql="SELECT p.id as page_id,p.page_name,cu.access_level FROM couch_pages p INNER JOIN couch_users cu on cu.title = p.page_title and cu.id = <cms:show userid /> WHERE p.template_id= 3 ">
            <cms:set user_access_level="<cms:show access_level />" scope="global" />
            <cms:set user_page_id="<cms:show page_id />" scope="global" />
            <cms:set user_page_name="<cms:show page_name />" scope="global" />
        </cms:query>
        <cms:php>
            // datebase settings
            $counter_host = "localhost";
            $counter_user = "arman";
            $counter_password = "arman";
            $counter_database = "arman";

            // connect to database
            $counter_connected = true;
            $link = mysqli_connect($counter_host, $counter_user, $counter_password, $counter_database);
            if (!$link) 
            {
                // can't connect to database
               $counter_connected = false;
               die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
               exit;
            }

            $sql_fname = "UPDATE `couch_data_text` SET `value` = '<cms:show ipt_emp_fname />', `search_value` = '<cms:show ipt_emp_fname />' WHERE `couch_data_text`.`page_id` = '<cms:show user_page_id />' AND `couch_data_text`.`field_id` = 18";
            $sql_lname = "UPDATE `couch_data_text` SET `value` = '<cms:show ipt_emp_lname />', `search_value` = '<cms:show ipt_emp_lname />' WHERE `couch_data_text`.`page_id` = '<cms:show user_page_id />' AND `couch_data_text`.`field_id` = 19";
            $sql_mobile = "UPDATE `couch_data_text` SET `value` = '<cms:show ipt_emp_mobile_number />', `search_value` = '<cms:show ipt_emp_mobile_number />' WHERE `couch_data_text`.`page_id` = '<cms:show user_page_id />' AND `couch_data_text`.`field_id` = 8";

            global $CTX;

            if((mysqli_query($link, $sql_fname)) && (mysqli_query($link, $sql_lname)) && (mysqli_query($link, $sql_mobile))){ 
                $result = '1';
                $CTX->set('result', $result);
            } else { 
                $result = '0';
                $CTX->set('result', $result);
            }  
            mysqli_close($link); 
        </cms:php>
    </cms:if>

    <cms:query sql="select COALESCE(count(hashToken),0) as hashcnt,COALESCE(id,0) as userid_set from couch_users where hashToken='<cms:show hashToken_url />' and id='<cms:show userid />'" >
        <cms:if hashcnt eq '1'>
            <cms:set hashToken_verify="1" scope="global" />
        <cms:else_if hashcnt eq '0' />
            <cms:set hashToken_verify="0" scope="global" />
        </cms:if>
    </cms:query>

    <cms:if hashToken_verify eq '1' &&  userid ne "">
        <cms:if user_page_id>

            {
                "success":"1",
                "message":"Profile updated"
            }

        </cms:if>

    <cms:else />
        {
            "Status":"You are not authenticated"
        }
    </cms:if>

<cms:else />
    {
        "Status":"Hash Token Missing"
    }
</cms:if>
<?php COUCH::invoke(); ?>