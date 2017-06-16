<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `rutilo_construction` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>시공방법</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/construction_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
                        <tr>
							<th>썸네일</th>
							<td><img src="<?php echo G5_DATA_URL."/construction/".$view['photo']; ?>" alt="썸네일" /></td>
						</tr>											
						<tr>
							<th>동영상 제목</th>
							<td><?php echo $view['title']; ?></td>
						</tr>
					   <tr>
							<th>내용</th>
							<td><?php echo $view['content']; ?></td>
						</tr>
                       	<tr>
							<th>동영상링크</th>
							<td><?php echo $view['videolink']; ?></td>
						</tr>
					
					    <tr>
							<th>etc</th>
							<td><?php echo $view['etc']; ?></td>
						</tr>							
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="<?php echo G5_URL."/admin/construction_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/construction_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
