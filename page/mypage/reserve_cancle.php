<?php
	include_once("../../common.php");

	sql_query("update `rutilo_reserve` set `status`='-1' where id='{$id}';");
	//send_reserve_GCM("삼시세끼 주문 취소","삼시세끼 주문 취소");

	alert('취소 되었습니다.');
	
	