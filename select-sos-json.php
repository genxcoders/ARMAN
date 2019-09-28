<?php require_once('couch/cms.php'); ?>
<cms:template title='Generated SOS JSON' />
<cms:content_type 'application/json'/>
<cms:pages masterpage='select-sos.php' limit='1' show_future_entries='1'>
    {
        "alarm-details":
        {
		    "sosid":<cms:escape_json><cms:show k_page_id /></cms:escape_json>,
            <cms:related_pages 'send_sos'>
	        "title":<cms:escape_json><cms:show k_page_title /></cms:escape_json>,
	        "trainno":<cms:escape_json><cms:show sos_train_no /></cms:escape_json>,
	        "locono":<cms:escape_json><cms:show sos_loco_no /></cms:escape_json>,
	        "sosdate":<cms:escape_json><cms:date sos_date format='M d, Y' /></cms:escape_json>,
	        "sostime":<cms:escape_json><cms:date sos_time format='H:i' /></cms:escape_json>,
	        "ohemast":<cms:escape_json><cms:related_pages 'sos_ohemast' ><cms:show k_page_title /></cms:related_pages></cms:escape_json>
	        </cms:related_pages>
	        
		}
    }
</cms:pages>
<?php COUCH::invoke(); ?>