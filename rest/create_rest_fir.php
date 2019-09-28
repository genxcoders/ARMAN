<?php require_once( '../couch/cms.php' ); ?>
<?php require_once( 'loginClass.php' ); ?>
<cms:template title='Receive FIR' />
<cms:php>
$data = json_decode(file_get_contents('php://input'),true);
$CTX->set('userid', $data['user_id'], 'global');
$CTX->set('hasToken', $data['hashToken'], 'global');

</cms:php>
JSON:<cms:php>global $data;echo $data['user_id'];</cms:php>
<cms:db_persist
    _auto_title         =   '0'
    _invalidate_cache   =   '0'
    _masterpage         =   'generate-fir.php'
    _mode               =   'create'
        
    k_page_title        =   "<cms:php>global $data;echo $data['user_id']);</cms:php>"
    k_page_name         =   "<cms:show k_page_title />"
    ipt_date            =   "<cms:date format='Y-m-d' />"
    ipt_time            =   "<cms:date format='H:i' />"
    ipt_train_no        =   "<cms:show train_no />"    
    ipt_loco_no         =   "<cms:show loco_no />"
    ipt_informer_id     =   "<cms:show informer_id />"
    ipt_informer_name   =   "<cms:show informer_name />"
    ipt_informer_no     =   "<cms:show informer_no />"
    ipt_disaster_image  =   "<cms:show disaster_image />"
    ipt_ohemast         =   "<cms:show ohemast />"
    ipt_lati            =   "<cms:show lati />"
    ipt_longi           =   "<cms:show longi />"
    ipt_desc            =   "<cms:show desc />"
    ipt_rad_status      =   "<cms:show rad_status />"
/>


<?php COUCH::invoke(); ?>