<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `best_model` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>제품관리</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table02">
				<table>
					<tr>
						<th>제품사진 *</th>
						<td>
						<?php if($view['photo']==""){ ?>
						<img src="<?php echo $view['photolink']; ?>" alt="image" />
						<?php }else{?>
						<img src="<?php echo G5_DATA_URL."/model/".$view['photo']; ?>" alt="image" />
						<?php }?>
						</td>
					</tr>
					<tr>
					    <th>제품사진 링크</th>
					    <td><?php echo $view['photolink'];?></td>
					</tr>
					<tr>
						<th>제품이름 *</th>
						<td><?php echo $view['name']; ?></td>
					</tr>
                	<tr>
						<th>제품가격 *</th>
						<td><?php echo $view['price']; ?></td>
					</tr>
				    <tr>
						<th>설명</th>
						<td><?php echo $view['content']; ?></td>
					</tr>
					<tr>
						<th>상세설명</th>
						<td><?php echo $view['content1']; ?></td>
						
					</tr>
					<tr>
					    <th>이미지 링크</th>
					    <td><?php echo $view['imglink'];?></td>
					</tr>
				</table>
			</div>
			
		
			<div class="text-center mt20" style="margin-bottom:20px;">
				<a href="<?php echo G5_URL."/admin/model_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
				<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/model_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
