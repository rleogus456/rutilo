<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `franch_status` where id='".$id."'");
	}
?>
<script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>가맹점관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/partner_update.php"; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $write['id']; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<tr>
							<th>썸네일</th>
							<td><input type="file" name="banner" id="banner" class="adm-input01" /></td>
						</tr>	
						<tr>
							<th>매장명</th>
							<td><input type="text" name="title" id="title" required class="adm-input01 grid_100" value="<?php echo $write['title']; ?>" /></td>
						</tr>
						<tr>
							<th>대표자</th>
							<td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
						</tr>
						<tr>
							<th>주소</th>
							<td>
							<input type="text" name="addr" id="addr" required class="adm-input01 grid_100 postcodify_postcode5"  value="<?php echo $write['addr']; ?>" />							
							<input type="text" name="addr2" id="addr2" required class="adm-input01 grid_100 postcodify_address" value="<?php echo $write['addr2']; ?>" />
							<input type="text" name="addr3" id="addr3" required class="adm-input01 grid_100 postcodify_details" value="<?php echo $write['addr3']; ?>" />
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989"><br>
							</td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><input type="tel" name="tel" id="tel" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['tel']; ?>" /></td>
						</tr>
							<tr>
							<th>팩스</th>
							<td><input type="tel" name="fax" id="fax" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['fax']; ?>" /></td>
						</tr>
                        <tr>
							<th>영업시간</th>
							<td><input type="text" name="opening" id="opening" required class="adm-input01 grid_100" value="<?php echo $write['opening']; ?>" /></td>
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
$(function(){ 
    $("#postcodify_search_button").postcodifyPopUp(); 
});
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
