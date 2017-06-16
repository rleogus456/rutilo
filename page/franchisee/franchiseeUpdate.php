<?php print_r($_REQUEST); ?>
<?php
	include_once("../../common.php");

	$mb_name=$_POST['mb_name'];
	$mb_email = trim($_POST["mb_email"]."@".$_POST["mb_email2"]);
    $mb_email2=$_POST['mb_email2'];
    $mb_hp = $_POST['mb_hp'];
	$mb_location =$_POST['reg_location'];
    $mb_question =$_POST['reg_question']; 
    
	if($is_member &&(!$member['mb_email'] && $mb_email) || (!$member['mb_name'] && $mb_name || $mb_1)){
		sql_query("update `best_member` set `mb_email`='{$mb_email}', `mb_name`='{$mb_name}', `mb_1`='{$mb_1}' where mb_id='{$member['mb_id']}'");
	}    
	sql_query("insert into `rutilo_franchisee` (`mb_name`,`mb_hp`,`mb_email`,`mb_email2`,`mb_question`,`mb_location`,`datetime`) values('{$mb_name}','{$mb_hp}','{$mb_email}','{$mb_email2}','{$mb_question}','{$mb_location}',NOW());");

//	$id=mysql_insert_id();
//	$model_data=sql_fetch("select * from rutilo_product where `id`='{$model}'");
//	send_reserve_GCM("삼시세끼 주문 요청","새로운 주문 요청");
//
//	$sql = "SELECT id FROM `rutilo_reserve` WHERE model in ('".$model."')";
//	$reserveid = sql_fetch($sql);
//	
//    if($member['regid'] && !$member['off_gcm']){
//        send_GCM($member['regid'],"삼시세끼","$mb_name 님의 주문이 요청이 완료 되었습니다.!");   
//    }
    alert('문의완료되었습니다.',G5_URL."/page/franchisee/franchisee.php?tab=franchisee");
//    alert('주문 처리되었습니다.. \n결제창으로 이동합니다.',G5_URL."/page/payapp/payapp_request.php?ids=".$ids."&reserveId=".$reserveid["id"]);