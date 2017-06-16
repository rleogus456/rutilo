<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `rutilo_reserve` where id='".$id."'");
		$write['start_arr']=explode(" ",$write['start']);
		$write['start_date']=$write['start_arr'][0];
		$write['start_arr']=explode(":",$write['start_arr'][1]);
		$write['start_hour']=$write['start_arr'][0];
		$write['start_min']=$write['start_arr'][1];
		$write['end_arr']=explode(" ",$write['end']);
		$write['end_date']=$write['end_arr'][0];
		$write['end_arr']=explode(":",$write['end_arr'][1]);
		$write['end_hour']=$write['end_arr'][0];
		$write['end_min']=$write['end_arr'][1];
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
	while($branch_data=sql_fetch_array($branch_query)){
		$branch_list[]=$branch_data;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>주문관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/reserve_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<colgroup>
							<col width="160px" />
							<col width="*" />
						</colgroup>
						<tr>
							<th>상태</th>
							<td>
								<select name="status" id="status" class="adm-input01 grid_100" required>
									<option value="">선택</option>
									<option value="-1" <?php echo isset($write['status'])&&$write['status']=="-1"?"selected":""; ?>>주문취소</option>
									<option value="0" <?php echo isset($write['status'])&&$write['status']=="0"?"selected":""; ?>>주문완료</option>
									<option value="1" <?php echo isset($write['status'])&&$write['status']=="1"?"selected":""; ?>>결제대기</option>
									<option value="2" <?php echo isset($write['status'])&&$write['status']=="2"?"selected":""; ?>>결제완료</option>
								</select>
							</td>
						</tr>
					
						<tr>
							<th>제품명</th>
							<td>
								<select name="model" id="model" class="adm-input01 grid_100"  required>
									<option value="<?php echo $write['model']?>"><?php echo $write['model']?></option>
									<?php
										for($i=0;$i<count($model_list);$i++){
									?>
										<option value="<?php echo $model_list[$i]['id']; ?>" <?php echo $write['model']==$model_list[$i]['id']?"selected":""; ?>><?php echo $model_list[$i]['name']; ?></option>
									<?php
										}
									?>
								</select>
							</td>
						</tr>
                         <tr>
							<th>가격</th>
							<td>
								<input type="text" name="price" id="price" class="adm-input01 grid_100 text-left" value="<?php echo $write['price']; ?>" onkeyup="return number_only(this);" required />
							</td>
						</tr>
					
						<tr>
							<th>주문자명</th>
							<td>
								<input type="text" name="mb_name" id="mb_name" class="adm-input01 grid_100" value="<?php echo $write['mb_name']; ?>" required />
							</td>
						</tr>
						<tr>
						<th>배송주소</th>
							<td>
								<input type="text" name="mb_addr" id="mb_addr" class="adm-input01 grid_100" value="<?php echo $write['mb_addr']; ?>" required />
							</td>
						<tr>
							<th>아이디</th>
							<td>
								<input type="text" name="mb_id" id="mb_id" class="adm-input01 grid_100" value="<?php echo $write['mb_id']; ?>" />
							</td>
						</tr>
						<tr>
							<th>이메일</th>
							<td>
								<input type="text" name="mb_email" id="mb_email" class="adm-input01 grid_100" value="<?php echo $write['mb_email']; ?>" />
							</td>
						</tr>
						<tr>
							<th>휴대폰</th>
							<td>
								<input type="tel" name="mb_phone" id="mb_phone" class="adm-input01 grid_100" value="<?php echo $write['mb_phone']; ?>" required />
							</td>
						</tr>
						<tr>
							<th>기타</th>
							<td>
								<textarea name="etc" id="etc" cols="30" rows="10" class="adm-input01 grid_100" style="height:150px"><?php echo strip_tags($write['etc']); ?></textarea>
							</td>
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
