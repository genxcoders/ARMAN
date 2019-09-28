<?php require_once('couch/cms.php'); ?>
<cms:set title="<cms:gpc 'k_page_title' method='get' />" scope="global" />
<cms:ignore>
<cms:set page_name="<cms:gpc 'k_page_name' method='get' />" scope="global" />
</cms:ignore>
<cms:set date="<cms:gpc 'fir_date' method='get' />" scope="global" />
<cms:set time="<cms:gpc 'fir_time' method='get' />" scope="global" />
<cms:set train_no="<cms:gpc 'fir_train_no' method='get' />" scope="global" />
<cms:set loco_no="<cms:gpc 'fir_loco_no' method='get' />" scope="global" />
<cms:set informer_id="<cms:gpc 'fir_informer_id' method='get' />" scope="global" />
<cms:set informer_name="<cms:gpc 'fir_informer_name' method='get' />" scope="global" />
<cms:set informer_no="<cms:gpc 'fir_informer_no' method='get' />" scope="global" />
<cms:set disaster_image="<cms:gpc 'fir_disaster_image_link' method='get' />" scope="global" />
<cms:set disaster_image_link="<cms:gpc 'fir_disaster_image_link' method='get' />" scope="global" />
<cms:set ohemast="<cms:gpc 'fir_ohemast' method='get' />" scope="global" />
<cms:set lati="<cms:gpc 'fir_lati' method='get' />" scope="global" />
<cms:set longi="<cms:gpc 'fir_longi' method='get' />" scope="global" />
<cms:set desc="<cms:gpc 'fir_desc' method='get' />" scope="global" />
<cms:set rad_status="<cms:gpc 'fir_rad_status' method='get' />" scope="global" />

<cms:content_type 'application/json'/>
<cms:db_persist
    _auto_title             =   '0'
    _invalidate_cache       =   '0'
    _masterpage             =   'generate-sos.php'
    _mode                   =   'create'
    
    k_page_title            =   "<cms:show title />"
    k_page_name             =   "<cms:show page_name />"
    sos_date                =   "<cms:date date format='Y-m-d' />"
    sos_time                =   "<cms:date time format='H:i' />"
    sos_train_no            =   "<cms:show train_no />"    
    sos_loco_no             =   "<cms:show loco_no />"
    sos_informer_id         =   "<cms:show informer_id />"
    sos_informer_name       =   "<cms:show informer_name />"
    sos_informer_no         =   "<cms:show informer_no />"
    sos_disaster_image      =   "<cms:show disaster_image />"
    sos_disaster_image_link =   "<cms:show disaster_image_link />"
    sos_di_64               =   "<cms:if disaster_image><cms:set fir_img_ext="<cms:show_securefile 'fir_disaster_image' ><cms:show file_ext /></cms:show_securefile>" scope="global" /><cms:php>global $b64_img;global $b64_data;$b64_img = file_get_contents('<cms:show disaster_image_link />');$b64_data = base64_encode($b64_img);echo 'data:image/<cms:show fir_img_ext />;base64,'.$b64_data;</cms:php></cms:if>"
    sos_ohemast             =   "<cms:show ohemast />"
    sos_lati                =   "<cms:show lati />"
    sos_longi               =   "<cms:show longi />"
    sos_desc                =   "<cms:show desc />"
    sos_rad_status          =   "<cms:show rad_status />"
>

    <cms:if k_error >
        <cms:abort>
            <cms:each k_error >
                <br><cms:show item />
            </cms:each>
        </cms:abort>
    <cms:else_if k_success />
        <cms:abort><cms:show k_last_insert_id /></cms:abort>
    </cms:if>
</cms:db_persist >
<?php COUCH::invoke(); ?>