<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `rutilo_trainer` where id='".$id."'");
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>트레이너</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/trainer_update.php"; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $write['id']; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<tr>
							<th>사진</th>
							<td><input type="file" name="photo" id="photo" class="adm-input01" /></td>
						</tr>						
						<tr>
							<th>트레이너명</th>
							<td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
						</tr>
                        <tr>
							<th>소속</th>
							<td><input type="text" name="belong" id="belong" required class="adm-input01 grid_100"  value="<?php echo $write['belong']; ?>" /></td>
						</tr>
                        <tr>
							<th>경력</th>
							<td><input type="text" name="career" id="career" required class="adm-input01 grid_100" value="<?php echo $write['career']; ?>" /></td>
						</tr> 
						<tr>
							<th>전화번호</th>
							<td><input type="tel" name="tel" id="tel" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['tel']; ?>" /></td>
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
