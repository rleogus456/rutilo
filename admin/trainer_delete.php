<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$dir=G5_DATA_PATH."/partner";
	$trainer=sql_fetch("select * from `rutilo_trainer` where id='".$id."'");
	sql_query("delete from `rutilo_trainer` where id='{$id}'");
	@unlink($dir."/".$trainer['photo']);
	alert("삭제 되었습니다.");