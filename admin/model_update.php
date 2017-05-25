<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$model=sql_fetch("select * from `best_model` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$name=$_POST['name'];
    $price=$_POST['price'];
    $type=$_POST['type'];
    $imglink=$_POST['imglink'];
    $photolink=$_POST['photolink'];
	$content=nl2br($_POST['content']); 
	$dir=G5_DATA_PATH."/model";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_model.jpg";
    $filename2=time()."_content.jpg";
	$path1=$dir."/".$filename1;
    $path2=$dir."/".$filename2;
	if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1100);
		$photo=$filename1;
		$photo_sql=",`photo`='".$filename1."'";
		if($id){
			@unlink($dir."/".$model['photo']);
		}
	}
	if($_FILES['content1']['tmp_name']){
		image_resize_update($_FILES['content1']['tmp_name'],$_FILES['content1']['name'], $path2, 1100);
		$content1=$filename2;
		$content1_sql=",`content1`='".$filename2."'";
		if($id){
			@unlink($dir."/".$model['content1']);
		}
	}
	if($id){        
		sql_query("update `best_model` set `name`='{$name}',`price`='{$price}',`content`='{$content}' {$content1_sql} {$photo_sql},`type`='{$type}',`imglink`='{$imglink}',`photolink`='{$photolink}' where `id`='{$id}'");
	}else{
        
		sql_query("insert into `best_model` (`photo`,`name`,`price`,`content`,`content1`,`type`,`imglink`,`photolink`) values('{$photo}','{$name}','{$price}','{$content}','{$content1}','{$type}','{$imglink}','{$photolink}')");
	}
	alert('저장되었습니다.',G5_URL."/admin/model_list.php?page=".$page);