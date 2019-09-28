<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Token Save' clonable='1' >
	<cms:editable type='uid' name='token_id' search_type='integer' order='1' />
	<cms:editable type='text' name='token_val' order='2' required='1' />
	<cms:editable type='datetime' name='token_date' format='Y-m-d' order='3' />
</cms:template>
<cms:set submit_success="<cms:get_flash 'submit_success' />" />
    <cms:if submit_success >
        <h4>Success: Your application has been submitted.</h4>
    </cms:if>

    <cms:form
        masterpage=k_template_name
        mode='create'
        enctype='multipart/form-data'
        method='post'
        anchor='0'
        >

        <cms:if k_success >
            <cms:db_persist_form
                _invalidate_cache='0'
                _auto_title='1'
            />
            <cms:if k_success >
            <cms:set_flash name='submit_success' value='1' />
            <cms:redirect k_page_link />
        	</cms:if>
        </cms:if>

        <cms:if k_error >
            <div class="error">
                <cms:each k_error >
                    <br><cms:show item />
                </cms:each>
            </div>
        </cms:if>
        <div id="token">
	        <cms:input name='token_val' type='bound' />
	    </div>
        <br/>
        <cms:hide>
        <cms:input name='token_date' type='bound' value="<cms:date format='Y-m-d' />" />
    	</cms:hide>
        <br/>
        <input type="submit" name="submit" value="Submit">
        </cms:form>

<?php COUCH::invoke(); ?>