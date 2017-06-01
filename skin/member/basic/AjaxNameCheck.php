<?php
include_once("../../../common.php");

$id = $_REQUEST["id"];
$rs = sql_query("SELECT * FROM g5_member where mb_id= '".$id."'");
$num = mysql_num_rows($rs);

if($num==0){
	echo "가입가능한 아이디입니다.";
    
    
}else{
	echo "이미 가입된 아이디입니다.";
    
}
?>