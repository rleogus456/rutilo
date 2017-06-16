<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$construction=sql_fetch("select * from `rutilo_construction` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$title=$_POST['title'];
    $content=$_POST['content'];
    $videolink=$_POST['videolink'];
    $etc=$_POST['etc'];
    
    $dir=G5_DATA_PATH."/construction";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_construction_photo.jpg";	
	$path1=$dir."/".$filename1;
	
	if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1100);
		$photo=$filename1;
		$photo_sql=",`photo`='".$filename1."'";
		@unlink($dir."/".$trainer['photo']);
	}
	
	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
	}
	if($id){
		sql_query("update `rutilo_construction` set `title`='{$title}',`content`='{$content}',`videolink`='{$videolink}',`etc`='{$etc}'{$photo_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `rutilo_construction` (`title`,`content`,`videolink`,`photo`,`etc`) values('{$title}','{$content}','{$videolink}','{$photo}','{$etc}');");
	}
   
	alert('저장되었습니다.',G5_URL."/admin/construction_list.php?page=".$page);