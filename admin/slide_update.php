<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$trainer=sql_fetch("select * from `rutilo_slide` where id='".$id."'");
	if(!$is_admin && $trainer['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];	
    $career=$_POST['category'];	
    $etc=$_POST['etc'];
 
	$dir=G5_DATA_PATH."/slide";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_slide_photo.jpg";	
	$path1=$dir."/".$filename1;
	
	if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1100);
		$photo=$filename1;
		$photo_sql="`photo`='".$filename1."'";
		@unlink($dir."/".$trainer['photo']);
	}
	
	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
	}
	if($id){
		sql_query("update `rutilo_slide` set {$photo_sql},`category`='{$category}',`etc`='{$etc}' where `id`='{$id}';");
	}else{
		sql_query("insert into `rutilo_slide` (`photo`,`category`,`etc`) values('{$photo}','{$category}','{$etc}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/slide_list.php?page=".$page);