<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `rutilo_center` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>트레이닝 센터</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/center_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
						<tr>
							<th>사진</th>
							<td><img src="<?php echo G5_DATA_URL."/center/".$view['photo']; ?>" alt="트레이너" /></td>
						</tr>					
						<tr>
							<th>센터명</th>
							<td><?php echo $view['name']; ?></td>
						</tr>
					   <tr>
							<th>위치</th>
							<td><?php echo $view['location']; ?></td>
						</tr>					
					    <tr>
							<th>etc</th>
							<td><?php echo $view['etc']; ?></td>
						</tr>							
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="<?php echo G5_URL."/admin/center_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/center_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
