<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `best_partner` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>협력업체관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/partner_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
						<tr>
							<th>업체이름</th>
							<td><?php echo $view['name']; ?></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><?php echo $view['tel']; ?></td>
						</tr>
						<tr>
							<th>배너</th>
							<td><img src="<?php echo G5_DATA_URL."/partner/".$view['banner']; ?>" alt="배너" /></td>
						</tr>
						<tr>
							<th>내용</th>
							<td><img src="<?php echo G5_DATA_URL."/partner/".$view['content']; ?>" alt="배너" /></td>
						</tr>
						<?php if($is_admin){ ?>
						<tr>
							<th>아이디</th>
							<td><?php echo $view['mb_id']; ?></td>
						</tr>
						<tr>
							<th>배너보이기</th>
							<td><?php echo $view['show']?"보이기":"안보임"; ?></td>
						</tr>
						<?php } ?>
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
