<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$view=sql_fetch("select * from `rutilo_reserve` where `id`='".$id."'");
		//$view=sql_fetch("select *,r.mb_id as mb_id, m.name as modelname,r.type as type,m.id as model_id,r.id as id from `best_reserve` as r left join `best_model` as m on r.model=m.id where r.id='".$id."'");
        //$reserve_view1=sql_fetch("select * from `best_reserve` where id={$id}");
        $count = count(explode(",",$view["model"]))-2;
		
		$model_id = explode(",",$view["model"]);
        $model_num=explode(",",$view["number"]);
		for($i=0;$i<count($model_id)-1;$i++){
			$sql = "SELECT * FROM `rutilo_product` where `id` in ('{$model_id[$i]}')";
			$modelname = sql_fetch($sql);
			$name[$i] = $modelname["name"];
            $product_id[$i]=$modelname["id"];
			$price = $price + $modelname["price"];     
            $sql1 = "SELECT * FROM `rutilo_reserve` where `id` in ('{$model_id[$i]}')";
            $sql2 = "SELECT * FROM `rutilo_delivery` where `id` in ('{$model_id[$i]}')";
            $modelnumber = sql_fetch($sql1);
            $deli = sql_fetch($sql2);
            $number[$i]=$model_num[$i];
            $total_price = $view['price'];
		}
        
		switch($view['status']){
			case "-1":$status="주문취소";break;
			case "0":$status="주문완료";break;
			case "1":$status="결제대기";break;
			case "2":$status="결제완료";break;
			default:$status="결제대기";break;
		}

		/*switch($view['range']){
			case "1":$range="~1개월";break;
			case "3":$range="~3개월";break;
			case "6":$range="~6개월";break;
			case "12":$range="~1년";break;
			case "36":$range="~3년";break;
			default:$range=floor((strtotime($view['end'])-strtotime($view['start']))/86400)."일".ceil(((strtotime($view['end'])-strtotime($view['start']))%86400)/3600)."시간";break;
		}*/
	}
	/*if(!$is_admin){
		$where.="and `branch`='{$branch['id']}'";
	}*/
	/*$car_sql="select *,b.name as company,c.id as id from `best_car` as c inner join `best_branch` as b on c.branch=b.id where `model`='{$view['model_id']}' and c.id not in (select car from `best_reserve` where ((`end`>='{$view['start']}' and `start`<='{$view['start']}') or (`end`>='{$view['end']}' and `start`<='{$view['end']}')) and `status`<>'-1') and `c_type`='{$type}' {$where}";
	$car_query=sql_query($car_sql);
	while($car_data=sql_fetch_array($car_query)){
		$car_list[]=$car_data;
	}*/
?>
<style type="text/css">
	.grid_90{width:90% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_10{width:10% !important;display:inline-block;float:left;box-sizing:border-box;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>주문관리</h1>
			<hr/>
		</header>
		<article>
			<div class="adm-table02">
				<table>
					<colgroup>
						<col width="160px" />
						<col width="*" />
					</colgroup>
					<tr>
						<th>상태</th>
						<td>
						<?php echo $status; ?>
						<?php
						if($view['status']<2 && $view['status']!=-1){
						?>
						<a href="<?php echo G5_URL."/admin/reserve_status.php?s=-1&id=".$id; ?>" style="background:#aaa;width:70px;text-align:center;height:25px;line-height:25px;color:#fff;display:inline-block">주문취소</a>
						<?php } ?>
						<?php
						if($view['status']==1){
						?>
						<a href="<?php echo G5_URL."/admin/reserve_status.php?s=2&id=".$id; ?>" style="background:#003;width:70px;text-align:center;height:25px;line-height:25px;color:#fff;display:inline-block">주문완료</a>
						<?php } ?>
						</td>
					</tr>

					<tr>
						<th rowspan="<?=(count($model_id)-1)?>">제품명</th>
                        <td><a href="<?php echo G5_URL."/page/rent/view.php?id=".$product_id[0]."&type=".$type."&cate=".$cate; ?>"><?=$name[0]?> </a>-<?php echo $number[0]?>개</td>
					</tr>	
					<?php 
						for($i=1;$i<count($model_id)-1;$i++){
					?>
					<tr>						
						<td><a href="<?php echo G5_URL."/page/rent/view.php?id=".$product_id[$i]."&type=".$type."&cate=".$cate; ?>"><?=$name[$i]?> </a>-<?php echo $number[$i]?>개</td>	
					</tr>
					<?php
					}
					?>
					<tr>
						<th>총 가격</th>
						<td><?php echo number_format($total_price); ?> <?php if($total_price < '50000') { ?>( 배송비 포함 ) <?php }?>  </td>
					</tr>
					<tr>
						<th>주문자명</th>
						<td><?php echo $view['mb_name']; ?></td>
					</tr>
					<tr>
					    <th>배송주소</th>
					    <td><?php echo $view['mb_addr']; ?></td>
					</tr>
					<tr>
						<th>아이디</th>
						<td><?php echo $view['mb_id']; ?></td>
					</tr>
				
					<tr>
						<th>이메일</th>
						<td><?php echo $view['mb_email']; ?></td>
					</tr>
					<tr>
						<th>휴대폰</th>
						<td><?php echo $view['mb_phone']; ?></td>
					</tr>		            
					<tr>
						<th>기타</th>
						<td><?php echo $view['etc']; ?></td>
					</tr>
			
				</table>
			</div>
			<div class="text-center mt20">
				<a href="<?php echo G5_URL."/admin/reserve_list.php"; ?>" class="btn adm-btn01" style="background:#aaa;">취소</a>
				<a href="<?php echo G5_URL."/admin/reserve_write.php?id=".$id."&page=".$page."&b=".$b."&m=".$m."&s=".$s; ?>" class="btn adm-btn01">수정</a>
			</div>
		</article>
	</section>
</div>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
	$(function(){
		$( "#start_date" ).datepicker({
			dateFormat:"yy-mm-dd",
			minDate: 0,
			onSelect: function( selectedDate ) {
				$( "#end_date" ).datepicker( "option", "minDate", selectedDate );
				/*var dateObject=new Date(selectedDate);
				dateObject.setDate(dateObject.getDate()+30);                                 
				$('#end_date').datepicker("option", "maxDate",dateObject);*/
			}
		});
		$( "#end_date" ).datepicker({
			dateFormat:"yy-mm-dd",
			minDate: 0,
			onSelect: function( selectedDate ) {
				$( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
				var dateObject=new Date(selectedDate);
				/*dateObject.setDate(dateObject.getDate()-30);   
				var now=new Date();
				var todayAtMidn = new Date(now.getFullYear(), now.getMonth(), now.getDate());
				if(dateObject.getTime()>todayAtMidn.getTime()){
					$('#start_date').datepicker("option", "minDate",dateObject);
				}*/
			}
		});
	});
	function rental_point_change(v){
		if(v=="픽업 서비스"){
			$("#pick").show();
		}
	}
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
