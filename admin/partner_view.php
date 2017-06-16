<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `franch_status` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>가맹점관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/partner_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
						<tr>
							<th>썸네일</th>
							<td><img src="<?php echo G5_DATA_URL."/partner/".$view['photo']; ?>" alt="배너" /></td>
						</tr>
						<tr>
							<th>매장명</th>
							<td><?php echo $view['title']; ?></td>
						</tr>
						<tr>
							<th>대표자</th>
							<td><?php echo $view['name']; ?></td>
						</tr>
						<tr>
							<th>주소</th>
							<td><?php echo $view['addr']; ?></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><?php echo $view['tel']; ?></td>
						</tr>
						<tr>
							<th>fax</th>
							<td><?php echo $view['fax']; ?></td>
						</tr>		
                    	<tr>
							<th>영업시간</th>
							<td><?php echo $view['opening']; ?></td>
						</tr>				
					    <tr>
							<th>etc</th>
							<td><?php echo $view['etc']; ?></td>
						</tr>							
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="<?php echo G5_URL."/admin/partner_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/partner_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
