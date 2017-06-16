<?php
include_once('../../common.php');
$id = $_POST['id'];
$list=sql_fetch("select * from `rutilo_trainer` where id='".$id."'");
?>

<div class="trainer">
	<header class="msg_head"><?php echo $list['name'];?> </header>
	<div class="msg_con">
	    <div class="msg_map">
	        <img src="<?php echo G5_DATA_URL."/trainer/".$list['photo']; ?>" alt="image" />
	    </div>
        <div class="msg_txt">            
	        <h2>소속 : <?php echo $list['belong']; ?></h2>
	        <h2>경력 : <?php echo $list['career']; ?></h2>
	        <h2>TEL : <?php echo $list['tel']; ?></h2>
	        <h2>기타 : <?php echo $list['etc']; ?></h2>
        </div>
	    	<div class="msg_btn_group">
			<a href="javascript:msg_close();" class="btn bg_darkred color_white">닫기</a>
		</div>
	</div>
</div>
