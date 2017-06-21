<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$model=sql_fetch("select * from `rutilo_product` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
    $code=$_POST['code'];
	$name=$_POST['name'];
    $price=$_POST['price'];
    $type=$_POST['type'];
    $imglink=$_POST['imglink'];
    $info=$_POST['info'];
    $photolink=$_POST['photolink'];
	$content=nl2br($_POST['content']);
    $msds=nl2br($_POST['msds']);
    $volume = $_POST['volume'];
    $components = $_POST['components'];
	$dir=G5_DATA_PATH."/model";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_model.jpg";
    $filename2=time()."_content.jpg";
    $filename3=time()."_info.jpg";
	$path1=$dir."/".$filename1;
    $path2=$dir."/".$filename2;
    $path3=$dir."/".$filename3;
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
		sql_query("update `rutilo_product` set `code`='{$code}',`name`='{$name}',`price`='{$price}',`content`='{$content}',`msds`='{$msds}',`info`='{$info}' {$content1_sql} {$photo_sql},`type`='{$type}',`volume`='{$volume}',`components`='{$components}',`imglink`='{$imglink}',`photolink`='{$photolink}' where `id`='{$id}'");
	}else{
        
		sql_query("insert into `rutilo_product` (`photo`,`code`,`name`,`price`,`content`,`content1`,`msds`,`info`,`type`,`volume`,`components`,`imglink`,`photolink`) values('{$photo}','{$code}','{$name}','{$price}','{$content}','{$content1}','{$msds}','{$info}','{$type}','{$volume}','{$components}','{$imglink}','{$photolink}')");
	}
	alert('저장되었습니다.',G5_URL."/admin/model_list.php?page=".$page);