<?php require_once( '../../couch/cms.php' ); ?>
<?php require_once( '../loginClass.php' ); ?>
<cms:template title='Receive FIR' />
<cms:content_type 'application/json'/>
<cms:php> 
$data = json_decode(file_get_contents('php://input'));
$CTX->set( 'userid', $data->user_id, 'global');
$CTX->set('hasToken', $data->hashToken, 'global');
$act_json = json_encode($data);
<!-- $verify_sql = "select * from couch_users where id={$data->user_id} and hashToken='".$data->hashToken."'";
$verify_res = mysqli_query($db,$verify_sql);
$verify_count = mysqli_num_rows($verify_res);
if($verify_count >0){
}else{
echo json_encode(array("status" => "you are not Authenticated"));
} -->


</cms:php>
<cms:if k_success>
        {
            
            <cms:capture into='json_fir.' is_json='1'>
            <cms:php> 
            global $act_json;
            </cms:php>
            </cms:capture>
            
        }
</cms:if>
<cms:ignore>
<cms:set title="<cms:gpc 'k_page_title' method='get' />" scope="global" />
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
<cms:db_persist
    _auto_title         =   '0'
    _invalidate_cache   =   '0'
    _masterpage         =   'generate-fir.php'
    _mode               =   'create'
        
    k_page_title        =   "<cms:show json_fir.title />"
    k_page_name         =   "<cms:show k_page_title />"
    ipt_date            =   "<cms:date format='Y-m-d' />"
    ipt_time            =   "<cms:date format='H:i' />"
    ipt_train_no        =   "<cms:show json_fir.train_no />"    
    ipt_loco_no         =   "<cms:show json_fir.loco_no />"
    ipt_informer_id     =   "<cms:show json_fir.informer_id />"
    ipt_informer_name   =   "<cms:show json_fir.informer_name />"
    ipt_informer_no     =   "<cms:show json_fir.informer_no />"
    ipt_disaster_image  =   "<cms:show json_fir.disaster_image />"
    ipt_ohemast         =   "<cms:show json_fir.ohemast />"
    ipt_lati            =   "<cms:show json_fir.lati />"
    ipt_longi           =   "<cms:show json_fir.longi />"
    ipt_desc            =   "<cms:show json_fir.desc />"
    ipt_rad_status      =   "<cms:show json_fir.rad_status />"
>

</cms:db_persist>

<?php COUCH::invoke(); ?>