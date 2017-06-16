<?php
	include_once('../../common.php');
	$ct_array=array();
	$act=trim($_POST['act']);
	$ct_array=$_POST['ct_id'];
	if($act=="delete"){
		for($i=0;$i<count($ct_array);$i++){
			sql_query("delete from `rutilo_cart` where `id`='{$ct_array[$i]}'");
		}
	}
	alert("수정 되었습니다.",G5_URL."/page/mypage/cart.php");
?>