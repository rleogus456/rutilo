<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `rutilo_construction` where id='".$id."'");
	}
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
				<input type="hidden" name="id" value="<?php echo $write['id']; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>									
						<tr>
							<th>동영상 제목</th>
							<td><input type="text" name="title" id="title" required class="adm-input01 grid_100" value="<?php echo $write['title']; ?>" /></td>
						</tr>
                        <tr>
							<th>내용</th>
							<td><input type="text" name="content" id="content" required class="adm-input01 grid_100"  value="<?php echo $write['content']; ?>" /></td>
						</tr>
                        <tr>
							<th>썸네일</th>
							<td><input type="file" name="photo" id="photo" class="adm-input01" /></td>
						</tr>	
                        <tr>
							<th>동영상 링크</th>
							<td><input type="text" name="videolink" id="videolink" required class="adm-input01 grid_100" value="<?php echo $write['videolink']; ?>" /></td>
						</tr> 				
                        <tr>
							<th>etc</th>
							<td><input type="text" name="etc" id="etc" required class="adm-input01 grid_100" value="<?php echo $write['etc']; ?>" /></td>
						</tr> 
					</table>
				</div>
				<div class="text-center mt20">
					<input type="submit" value="확인" class="adm-btn01" />
				</div>
			</form>
		</article>
	</section>
</div>
<script>

</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
