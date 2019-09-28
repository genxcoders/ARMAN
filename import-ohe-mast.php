<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Import OHE Mast' order="2" parent='_ohe_' >
    <cms:editable name='csv' required='0' allowed_ext='csv' max_size='2000000' type='securefile' label='CSV' has_header='0' />
</cms:template>
<cms:show_securefile 'csv' >
    <cms:query sql=
    "   
    SELECT sf.file_disk_name AS `name`, sf.file_extension AS `extension`
      FROM <cms:php>echo K_TBL_ATTACHMENTS;</cms:php> sf
     WHERE sf.attach_id = <cms:show file_id />
    "
    >
    <cms:set securefile_handle = "<cms:concat name '.' extension />" scope='global' />
    <cms:set securefile_fullpath = "<cms:php>global $Config; echo $Config['UserFilesAbsolutePath'].'attachments'.'/';</cms:php><cms:concat name '.' extension />" scope='global' />
    </cms:query>
</cms:show_securefile>

<cms:set mystart="<cms:gpc 'import' method='get' />" />
<cms:if mystart >
    <cms:csv_reader
        file=securefile_fullpath
        limit='0'
        paginate='1'
        has_header='0'
        prefix='_'
    >
        
        Total OHE Mast records imported: <strong><cms:show k_total_records /></strong>.<br>

        <cms:set my_template_name = 'ohe-mast.php' />
        <cms:set my_page_title="<cms:show _col_2 /> <cms:show _col_4 />" />
        <cms:php>
            global $CTX, $FUNCS;
            $name = $FUNCS->get_clean_url( "<cms:show my_page_title />" );
            $CTX->set( 'my_page_name', $name ); 
        </cms:php>
        <cms:set my_page_id='' 'global' />
        <cms:pages masterpage=my_template_name page_name=my_page_name limit='1' show_future_entries='1'>
            <cms:set my_page_id=k_page_id  'global' />
        </cms:pages>    
        <cms:pages masterpage=k_user_template show_future_entries='1'>
            <cms:set empid="<cms:show employee_code />" scope='global' />
        </cms:pages>
        <cms:if my_page_id=''>
            <cms:db_persist
                _auto_title         = '0'
                _invalidate_cache   = '0'
                _masterpage         = 'ohe-mast.php'
                _mode               = 'create'

                k_page_title        = "<cms:show _col_2 /> <cms:show _col_4 />"
                k_page_name         = "<cms:show k_page_title />"

                ipt_rec_no          = _col_1
                ipt_div             = _col_2
                ipt_sec             = _col_3
                ipt_ohe_mast        = _col_4
                ipt_lati            = _col_5
                ipt_long            = _col_6
                ipt_alti            = _col_7
            >
                <cms:if k_error>
                    <strong style="color:red;">ERROR:</strong> <cms:show k_error/>
                </cms:if>
            </cms:db_persist>
        <cms:else />
            Data already exists!<br />
        </cms:if>
    </cms:csv_reader> 
<cms:else />
    <cms:form masterpage=k_template_name 
        mode='edit'
        page_id=k_page_id
        enctype="multipart/form-data"
        method='post'
        anchor='0'
        id='csv_file_form'
    >
    <cms:if k_success >        

        <cms:db_persist_form />

        <cms:if k_success >
            
            <cms:pages show_future_entries='1' >
                <cms:show_securefile 'csv' >
                    <cms:set uploaded_csv = file_id scope='global' />
                </cms:show_securefile>
            </cms:pages>
            
            <cms:if uploaded_csv >
                <cms:redirect "<cms:add_querystring k_template_link 'import=1' />" /> 
                <cms:redirect url="<cms:link k_site_link />" />
            <cms:else />
                <cms:redirect "<cms:show k_template_link />" /> 
            </cms:if>
            
        </cms:if>    
    </cms:if>

    <cms:if k_error >
        <font color='red'><cms:each k_error ><cms:show item /><br /></cms:each></font>
    </cms:if>
    
    <cms:hide>
        <cms:input name='csv' type="bound" />
    </cms:hide>
        
    <label for="csv_input" >Attach CSV file</label>
    <input name='f_csv' id="csv_input" style="/*display:none;*/" type="file" class="file-styled" placeholder="" />
</cms:form>
<button class="btn btn-primary" type="submit" form="csv_file_form" >Start!<i class="icon-arrow-right14 position-right"></i></button>
</cms:if>
<?php COUCH::invoke(); ?>