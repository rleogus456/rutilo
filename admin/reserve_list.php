<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	$where="1";
	if(!$b && !$is_admin){
		goto_url(G5_URL."/admin/reserve_list.php?b=".$branch['id']);
	}
	if($m)
		$where.=" and r.`model`='{$m}'";

	if($s)
		$where.=" and r.`status`='{$s}'";
	if($sel!="" && $search!=""){
		$where.=" and `{$sel}` like '%{$search}%'";
	}
	$total=sql_fetch("select count(*) as cnt from `rutilo_reserve` as r left join `rutilo_product` as m on r.model=m.id where {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select *,m.name as model,r.id as id from `rutilo_reserve` as r left join `rutilo_product` as m on r.model=m.id where {$where} order by r.`id` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['number']=$total-($start)-$j;
		$j++;
        $count = count(explode(",",$list[$j]['model']))-2;
    }
	$where="1";
	if(!$is_admin){
		$where="`mb_id`='{$member['mb_id']}'";
	}
	$model_query=sql_query("select * from `rutilo_product`");
	$branch_query=sql_query("select * from `best_branch` where {$where}");
	while($model_data=sql_fetch_array($model_query)){
		$model_list[]=$model_data;
	} 
    
?>
<style type="text/css">
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.lh30{line-height:30px !important;}
	.mt30{margin-top:30px;}
</style>
<!-- 본문 start -->


<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>주문관리</h1>
			<hr />
		</header>
		<article>
			<div class="text-right" >
				<select name="s" id="s" class="adm-input01" style="width:90px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/reserve_list.php?s='+this.value+'m=".$m."&b=".$b; ?>'">
					<option value="">상태검색</option>
					<option value="-1" <?php echo isset($s)&&$s==-1?"selected":""; ?>>주문취소</option>
					<option value="0" <?php echo isset($s)&&$s!=""&&$s==0?"selected":""; ?>>주문완료</option>
					<option value="1" <?php echo isset($s)&&$s!=""&&$s==1?"selected":""; ?>>결제대기</option>
					<option value="2" <?php echo isset($s)&&$s==2?"selected":""; ?>>결제완료</option>
				</select>
				<select name="m" id="m" class="adm-input01" style="width:90px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/reserve_list.php?s=".$s."&m='+this.value+'&b=".$b; ?>'">
					<option value="">제품검색</option>
					<?php
						for($i=0;$i<count($model_list);$i++){
					?>
						<option value="<?php echo $model_list[$i]['id']; ?>" <?php echo $m==$model_list[$i]['id']?"selected":""; ?>><?php echo $model_list[$i]['name']; ?></option>
					<?php
						}
					?>
				</select>
				<select name="b" id="b" class="adm-input01" style="width:90px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/reserve_list.php?s".$s."&m=".$m."&b='+this.value"; ?>;">
				
					<?php
						for($i=0;$i<count($branch_list);$i++){
					?>
						<option value="<?php echo $branch_list[$i]['id']; ?>" <?php echo $b==$branch_list[$i]['id']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="grid_100 mt20">
				<form action="" method="get">
					<input type="hidden" name="s" />
					<input type="hidden" name="m" />
					<input type="hidden" name="b" />
					<div class="grid_25">
						<select name="sel" id="sel" class="grid_100 adm-input01">
							<option value="mb_id" <?php echo $sel=="mb_id"?"selected":""; ?>>아이디</option>
							<option value="mb_name" <?php echo $sel=="mb_name"?"selected":""; ?>>이름</option>
						</select>
					</div>
					<div class="grid_60 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo $search; ?>" /></div>
					<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
				</form>
			</div>
			<div class="adm-table01 mt30">
				<table>
					<thead>
						<tr>
							<th class="md_none">일시</th>							
							<th class="md_none">제품이름</th>
							<th>주문자</th>
							<th>연락처</th>
							<th>배송주소</th>
							<th>상태</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
							switch($list[$i]['status']){
								case "-1":$status="주문취소";break;
								case "0":$status="주문완료";break;
								case "1":$status="결제대기";break;
								case "2":$status="결제완료";break;
								default:$status="결제대기";break;
							}
					?>
					
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo date("Y-m-d",strtotime($list[$i]['datetime'])); ?><br /><?php echo date("H:i:s",strtotime($list[$i]['datetime'])); ?></td>						
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['model']; if($count>0) {echo " 외 ".$count."개";} ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['mb_name']; ?><?php echo $list[$i]['mb_id']?"<br />(".$list[$i]['mb_id'].")":""; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo hyphen_hp_number($list[$i]['mb_phone']); ?></td>
                           	<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo  $list[$i]['mb_addr']; ?></td>					
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $status; ?></td>
							<td><a href="<?php echo G5_URL."/admin/reserve_write.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn01">수정/ </a><a href="<?php echo G5_URL."/admin/reserve_delete.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn01">삭제 </a></td>
						</tr>
					<?php
						}
						if(count($list)==0){
					?>
						<tr>
							<td colspan="9" class="text-center" style="padding:50px 0;">주문요청이 없습니다.</td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
				if($total_page>1){
					$start_page=1;
					$end_page=$total_page;
					if($total_page>5){
						if($total_page<($page+2)){
							$start_page=$total_page-4;
							$end_page=$total_page;
						}else if($page>3){
							$start_page=$page-2;
							$end_page=$page+2;
						}else{
							$start_page=1;
							$end_page=5;
						}
					}
			?>
			<div class="num_list01">
				<ul>
				<?php if($page!=1){?>
					<li class="prev"><a href="<?php echo G5_URL."/admin/reserve_list.php?b=".$b."&s=".$s."&m=".$m."&page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/reserve_list.php?b=".$b."&s=".$s."&m=".$m."&page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/reserve_list.php?b=".$b."&s=".$s."&m=".$m."&page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
			<div class="text-right mt20">
				<a href="<?php echo G5_URL."/admin/reserve_write.php"; ?>" class="adm-btn01">주문추가</a>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
