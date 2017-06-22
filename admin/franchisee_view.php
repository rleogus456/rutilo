<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `rutilo_franchisee` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>문의내용</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/franchisee_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
					    <tr>
							<th>등록일</th>
							<td><?php echo $view['datetime']; ?></td>
						</tr>
						<tr>
							<th>성명</th>
							<td><?php echo $view['mb_name']; ?></td>
						</tr>
					   <tr>
							<th>전화번호</th>
							<td><?php echo $view['mb_hp']; ?></td>
						</tr>
                       	<tr>
							<th>이메일</th>
							<td><?php echo $view['mb_email']; ?></td>
						</tr>
							
					    <tr>
							<th>문의 내용</th>
							<td><?php echo $view['mb_question']; ?></td>
						</tr>							
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">					
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/franchisee_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
