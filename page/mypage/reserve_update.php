<?php
	include_once("../../common.php");
    
    $ids=$_REQUEST['ids'];
	$page=$_POST['page'];
	$status=$_POST['status'];
    $number=$_POST['number'];	
	$range=$_POST['range'];
	$pick=$_POST['pick'];
    $mb_id=$_POST['mb_id'];
	$mb_name=$_POST['mb_name'];
    $mb_name2=$_POST['mb_name2'];
	$mb_name=$_POST['mb_name'];
	$mb_email=$_POST['mb_email'];
    $mb_email2=$_POST['mb_email2'];
	$mb_phone=$_POST['mb_hp'];
    $mb_phone2=$_POST['mb_hp2'];
    $mb_addr=$_POST['mb_addr1'].$_POST['mb_addr2'].$_POST['mb_addr3'];
    $mb_addr2=$_POST['mb_addr4'].$_POST['mb_addr5'].$_POST['mb_addr6'];
    $model=$_POST['model'];
    $use_point = $_POST['mb_point'];
	$mb_requested=nl2br($_POST['mb_requested']);
	$price=$_POST['price'];
    $payment=$_POST['chk_info'];
    
	if($is_member &&(!$member['mb_email'] && $mb_email) || (!$member['mb_name'] && $mb_name || $mb_1)){
		sql_query("update `best_member` set `mb_email`='{$mb_email}', `mb_name`='{$mb_name}', `mb_1`='{$mb_1}' where mb_id='{$member['mb_id']}'");
	}    
	sql_query("insert into `rutilo_reserve` (`number`,`mb_id`,`mb_name`,`mb_addr`,`mb_email`,`mb_phone`,`price`,`payment`,`status`,`datetime`,`model`,`cart_id`) values('{$number}','{$mb_id}','{$mb_name}','{$mb_addr}','{$mb_email}','{$mb_phone}','{$price}','{$payment}','0',NOW(),'{$model}','{$ids}');");
    sql_query("insert into `rutilo_delivery` (`number`,`mb_id`,`mb_name`,`mb_addr`,`mb_phone`,`use_point`,`price`,`requested`,`status`,`datetime`,`model`,`cart_id`) values('{$number}','{$mb_id}','{$mb_name2}','{$mb_addr2}','{$mb_phone2}','{$use_point}','{$price}','{$mb_requested}','0',NOW(),'{$model}','{$ids}');");

//	$id=mysql_insert_id();
//	$model_data=sql_fetch("select * from rutilo_product where `id`='{$model}'");
//	send_reserve_GCM("삼시세끼 주문 요청","새로운 주문 요청");
//
	$sql = "SELECT id FROM `rutilo_reserve` WHERE model in ('".$model."')";
	$reserveid = sql_fetch($sql);
    
//    if($member['regid'] && !$member['off_gcm']){
//        send_GCM($member['regid'],"삼시세끼","$mb_name 님의 주문이 요청이 완료 되었습니다.!");   
//    }
     alert('주문 완료되었습니다.',G5_URL."/page/mypage/reserve_result.php?tab=form&id=".$reserveid['id']);
//    alert('주문 처리되었습니다.. \n결제창으로 이동합니다.',G5_URL."/page/payapp/payapp_request.php?ids=".$ids."&reserveId=".$reserveid["id"]);