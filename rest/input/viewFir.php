<?php require_once( '../../couch/cms.php' ); ?>
<cms:template title='View FIR' />

<cms:set title="<cms:gpc 'page_id' method='post' />" scope="global" />


<cms:ignore>
<cms:set name="<cms:gpc 'k_page_name' method='get' />" scope="global" />
<cms:set date="<cms:gpc 'ipt_date' method='get' />" scope="global" />
<cms:set time="<cms:gpc 'ipt_time' method='get' />" scope="global" />
<cms:set train_no="<cms:gpc 'ipt_train_no' method='get' />" scope="global" />
<cms:set loco_no="<cms:gpc 'ipt_loco_no' method='get' />" scope="global" />

<cms:set informer_id="<cms:gpc 'ipt_informer_id' method='get' />" scope="global" />
<cms:set informer_name="<cms:gpc 'ipt_informer_name' method='get' />" scope="global" />

<cms:set informer_no="<cms:gpc 'ipt_informer_no' method='get' />" scope="global" />
<cms:set disaster_image="<cms:gpc 'ipt_disaster_image' method='get' />" scope="global" />
<cms:set ohemast="<cms:gpc 'ipt_ohemast' method='get' />" scope="global" />
<cms:set lati="<cms:gpc 'ipt_lati' method='get' />" scope="global" />
<cms:set longi="<cms:gpc 'ipt_longi' method='get' />" scope="global" />
<cms:set desc="<cms:gpc 'ipt_desc' method='get' />" scope="global" />
<cms:set rad_status="<cms:gpc 'ipt_rad_status' method='get' />" scope="global" />
</cms:ignore>


<cms:content_type 'application/json'/>
<cms:db_persist
    _auto_title         =   '0'
    _invalidate_cache   =   '0'
    _masterpage         =   'generate-fir.php'
    _mode               =   'view'
    id                  =   "<cms:page_id/>"    
>
	<cms:if k_error >
        {
            "error":"0",
	        <cms:each k_error >
            "value":<cms:escape_json><cms:show item /><br></cms:escape_json>
	        </cms:each>
        }
    <cms:else />
    	{
    		"success":"1",
    		"id":"<cms:show k_last_insert_id />",
            "title":<cms:escape_json><cms:show k_page_title /></cms:escape_json>
    	}
    </cms:if>
</cms:db_persist>

<?php COUCH::invoke(); ?>