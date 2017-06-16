<?php
	include_once("../common.php");
    $id=$_POST['id'];+
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
	
    
	if($id){
		$reserve=sql_fetch("select * from `rutilo_reserve` where id='".$id."'");		
		if(!$is_admin){
			alert("권한이 없습니다.");
		}
	}   
    if($id){
		sql_query("update `rutilo_reserve` set `mb_id`='{$mb_id}',`mb_name`='{$mb_name}',`mb_addr`='{$mb_addr}',`mb_email`='{$mb_email}',`mb_phone`='{$mb_phone}',`price`='{$price}',`status`='{$status}',`model`='{$model}' where id='{$id}';");
	}else{
		sql_query("insert into `rutilo_reserve` (`mb_id`,`mb_name`,`mb_email`,`mb_phone`,`price`,`status`,`datetime`,`model`) values('{$mb_id}','{$mb_name}','{$mb_email}','{$mb_phone}','{$price}','{$status}',NOW(),'{$model}');");
		$id=mysql_insert_id();
	}
    if($status==2 && (!$reserve['status'] || $reserve['status']!=$status) && $mb_id){
		$point=$price/100;
		sql_query("update `g5_member` set `mb_point`=`mb_point`+{$point} where mb_id='{$mb_id}'");
		sql_query("insert into `point_log` (`mb_id`,`point`,`datetime`,`re_id`) values('{$mb_id}','{$point}',now(),'{$id}')");
	}
	alert('저장되었습니다.',G5_URL."/admin/reserve_list.php?page=".$page);

//	$id=mysql_insert_id();
//	$model_data=sql_fetch("select * from rutilo_product where `id`='{$model}'");
//	send_reserve_GCM("삼시세끼 주문 요청","새로운 주문 요청");
//
//	$sql = "SELECT id FROM `best_reserve` WHERE model in ('".$model."')";
//	$reserveid = sql_fetch($sql);
//	
//    if($member['regid'] && !$member['off_gcm']){
//        send_GCM($member['regid'],"삼시세끼","$mb_name 님의 주문이 요청이 완료 되었습니다.!");   
//    }
     alert('주문 완료되었습니다.',G5_URL."/page/mypage/reserve_result.php?id=".$id);
//    alert('주문 처리되었습니다.. \n결제창으로 이동합니다.',G5_URL."/page/payapp/payapp_request.php?ids=".$ids."&reserveId=".$reserveid["id"]);