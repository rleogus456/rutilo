<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$sql="select * from `g5_member` order by `mb_no` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$member_list[$j]=$data;
		$member_list[$j]['num']=$j+1;
		$j++;
	}
	$sql="select *,m.name as model,c.number as car,r.id as id from `rutilo_reserve` as r left join `rutilo_product` as m on r.model=m.id order by r.`id` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$reserve_list[$j]=$data;
		$reserve_list[$j]['num']=$j+1;
		$j++;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>관리자페이지</h1>
			<hr />
		</header>
		<article>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">회원관리 <a href="<?php echo G5_URL."/admin/member_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th class="md_none">이메일</th>
							<th>휴대폰번호</th>
							<th>포인트</th>
							<th class="md_none">가입일</th>
							<th class="md_none">최종접속일</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($member_list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['num']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_id']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_email']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_point']?number_format($member_list[$i]['mb_point']):0; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_datetime'])); ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_today_login'])); ?></td>
							<td><a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$member_list[$i]['mb_no']; ?>"><?php echo $member_list[$i]['mb_intercept_date']?"활성":"정지"; ?></a></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
