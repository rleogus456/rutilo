<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$partner=sql_fetch("select * from `franch_status` where id='".$id."'");
	if(!$is_admin && $partner['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$name=$_POST['name'];
    $title=$_POST['title'];
	$tel=$_POST['tel'];
    $fax=$_POST['fax'];
    $opening=$_POST['opening'];
    $etc=$_POST['etc'];
	$addr=$_POST['addr'].$_POST['addr2'].$_POST['addr3'];
    $addr2=$_POST['addr2'].$_POST['addr3'];
 
	$dir=G5_DATA_PATH."/partner";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_partner_banner.jpg";	
	$path1=$dir."/".$filename1;
	
	if($_FILES['banner']['tmp_name']){
		image_resize_update($_FILES['banner']['tmp_name'],$_FILES['banner']['name'], $path1, 1100);
		$banner=$filename1;
		$banner_sql=",`banner`='".$filename1."'";
		@unlink($dir."/".$partner['banner']);
	}
	
	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
	}
	if($id){
		sql_query("update `franch_status` set `title`='{$title}',`name`='{$name}',`tel`='{$tel}',`fax`='{$fax}',`addr`='{$addr}',`addr2`='{$addr2}',`opening`='{$opening}',`etc`='{$etc}'{$banner_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `franch_status` (`title`,`name`,`tel`,`addr`,`addr2`,`fax`,`opening`,`etc`,`photo`) values('{$title}','{$name}','{$tel}','{$addr}','{$addr2}','{$fax}','{$opening}','{$etc}','{$banner}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/partner_list.php?page=".$page);