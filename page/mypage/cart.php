<?php
include_once('../../common.php');
include_once(G5_PATH.'/head.php');
$date1=date("Y-m-d H:i:s",strtotime("-1 days"));
$cart_session=get_session("cart_session");
if(!$cart_session){
	$cart_session="";
	for($i=0;$i<6;$i++){
		$c=rand(0,9);
		$cart_session.=$c;
	}
	set_session('cart_session',$cart_session);
}
if($is_member)
	$where="`mb_id`='{$member['mb_id']}'";
else
	$where="`mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_session`='{$cart_session}' and `mb_id`='' and c.`datetime`>'{$date1}'";

$sql="select *,c.id as id,c.number as number,p.photo as photo,p.photolink as photo2 from `rutilo_cart` as c inner join `rutilo_product` as p on c.product_id=p.id where {$where} and od_status='0' order by c.datetime desc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}

?>

<section class="section03">
    <header>
		<h4>장바구니</h4>
		    <p>루틸로에 오신 것을 환영 합니다.</p>
		    <div class="width-fixed">
		        <nav class="section03_nav">
                    <ul class="list3">
                        <li class="active" style="width:28%"><a><span class="texts">STEP 01</span> <br>장바구니</a></li>
                        <li style="width: 5%;vertical-align: top;padding-top:5px"><img src="../../img/section03_navImg.jpg" alt=""></li>
                        <li style="width:28%"><a><span class="texts">STEP 02</span> <br>주문결제</a></li>
                        <li style="width: 5%;vertical-align: top;padding-top:5px"><img src="../../img/section03_navImg.jpg" alt=""></li>
                        <li style="width:28%"><a><span class="texts">STEP 03</span> <br>주문완료</a></li>
                    </ul>
                </nav>  
		    </div>
		</header>
 
	<article id="mall_buy" class="wrap">		
		<div class="width-fixed">
			<form action="<?php echo G5_URL."/page/mypage/order_form.php"; ?>" method="post" name="cart_list" id="cart_list">
				<input type="hidden" name="act" value="" />
				<input type="hidden" name="ids" id="ids" />
				<div class="price_info" id="cart">
					<table>
						<thead>
							<tr>
								<th class="check"><input type="checkbox" name="all" id="all" onchange="if (this.checked) all_checked(true); else all_checked(false);" checked /></th>
								<th class="code">상품코드</th>
								<th class="info">제품정보</th>
								<th class="num">수량</th>
								<th class="price">가격/<br>마일리지</th>
								<th class="cart">주문</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$total_num=0;
						$total_price=0;
                        $delivery = '4000';
						for($i=0;$i<count($list);$i++){
							$out=false;
							$number=$list[$i]['number'];	
                             $price=$list[$i]['price'];
                             $price=$list[$i]['price']*$number;
					        $total_num+=$number;
							$total_price+=$price;                            
                            sql_query("update `rutilo_cart` set price`='{$price}' where `id` = '{$list[$i]['id']}'");
						?>
							<tr<?php echo $out?" class='out'":""; ?>>
								<td class="check"><input type="checkbox" name="ct_id[]" id="ct_id<?php echo $list[$i]['id']; ?>"onClick="chkboxClick(this)" value="<?php echo $list[$i]['id']; ?>" <?php echo $out?"":"checked"; ?> /></td>
								<td class="code"><?php echo $list[$i]['code']; ?></td>
								<td class="info">
								<a href="<?php echo G5_URL."/page/view.php?id=".$list[$i]['product_id']; ?>" target="_blank">
									<div>
										<div class="img"><div><div><img src="<?php if($list[$i]['photo']){ echo G5_DATA_URL."/model/".$list[$i]['photo'];}else{echo $list[$i]['photo2'];} ?>" alt="<?php echo $list[$i]['name']; ?>" /></div></div></div>
										<div class="title">
<!--											<h4><?php echo str_replace("|","/",$list[$i]['type']); ?></h4>-->
											<h3><?php echo $list[$i]['name']; ?></h3>
											<p>[ <?php echo $list[$i]['components']; ?> ]</p>
										</div>
									</div>
                                    </a>
								</td>
								<td class="num">
									<input type="text" name="number[]" id="number<?php echo $list[$i]['id']; ?>" value="<?php echo $list[$i]['number']; ?>" class="number_input" onblur="num_enter(this);" data-max="<?php echo $list[$i]['out']?0:$list[$i]['total']-$list[$i]['sell']; ?>" data-id="<?php echo $list[$i]['id']; ?>" />
									<input type="hidden" name="price[]" id="price<?php echo $list[$i]['id']; ?>" value="<?php echo $list[$i]['price']; ?>" class="price_input" />
									<input type="hidden" name="total_price[]" id="total_price<?php echo $list[$i]['id']; ?>" value="<?php echo ceil($price); ?>" class="total_price_input" />
								</td>
								<td class="price">
									 <?php echo number_format(ceil($price),0); ?>원 <br> <?php  echo $price/100; ?> 마일리지
								</td>
								<td class="cart">
								    <input type="button" value="바로구매" class="buy_btn" onclick="return form_check('buy');" />
								    <input type="button" value="삭제" class="delete_btn2" onclick="return form_check('delete');" />
								</td>
							</tr>
						<?php }
                       
						if(count($list)<=0){
						?>
						<tr>
							<td colspan="6">장바구니에 목록이 없습니다.</td>
						</tr>
						<?php
						}else{
						?>										
						
						<?php
						}
						?>
						</tbody>
					</table>		
					<input type="button" value="선택 삭제" class="delete_btn" onclick="return form_check('delete');" />		
					<div class="cartInfo">
					    <h2>총 주문금액</h2>
					    <div class="price">
					        <h2>상품 총 금액 <span class="text-r" id="total"><?php echo $total_price;?>원</span></h2>					        
					    </div>
					    
					    <div class="delivery">
					        <h2>배송료 <span class="text-r" id="deli"><?php echo $delivery; ?>원</span></h2>
					    </div>
					    <div class="line"></div>
<!--
					    <?php  if($total_price < '50000' ){
                            $total_price = $total_price + $delivery;
                        } ?>
-->
					    <div class="tot_price">
                            <p class="point">(적립마일리지 <span id="point"><?php echo $total_price/'100'; ?></span>P)</p>
					        <h2>결제예정금액 <span class="text-r" id="totdel"><?php echo $total_price ;?>원</span></h2>
					    </div>
					</div>			
				</div>	
				<div class="cartTip">
				    <h2>TIP.</h2>
				    <ul>
				        <li>- 배송비 관련 정책 : 00000원 이상 결제시 무료 배송</li>
				        <li>- 장바구니는 접속 종료 후 00일 동안만 보관 됩니다.</li>
				        <li>- 업체배송 및 업체 조건배송, 업체착불배송 상품은 해당 업체에서 별도 배송되오니 참고하여 주시기 바랍니다.</li>
				    </ul>				 
				</div>				
				<div class="btn_group01">
					<input style="background-color:#fff" type="button" value="계속쇼핑하기" class="btn1 grid_30" onclick="return form_check('more');" />
					<input  type="button" value="구매하기" class="btn grid_30" onclick="return form_check('buy');" />
				</div>	
					
			</form>
		</div>
	</article>
</section>
<script type="text/javascript">  
   
	function all_checked(sw) {
		var f = document.cart_list;
		for (var i=0; i<f.length; i++) {
			if (f.elements[i].name == "ct_id[]")
				f.elements[i].checked = sw;
		}
	}
	function num_enter(t){
		number_only(t);
		var ct_id = $(t).attr("data-id");
		var price1 = $(t).parent().find("#price"+ct_id).val();
		var max_num=$(t).attr("data-max");
		var num_var=parseInt($(t).val());
		if($(t).val()=="" || num_var<=0){
			alert("잘못된 접근입니다.");
			$(t).val(1);
			num_var=1;
		}
		if(max_num==0){
//			alert("품절되었습니다.");
//			$(t).parent().parent().remove();
		}else if(max_num<num_var){
//			alert("더이상 수량을 줄일수 없습니다.");
//			$(t).val(max_num);
//			num_var=max_num;
		}
		$.post("./ajax.cart_num_update.php",{"id":ct_id,"number":num_var},function(data){})
		var total_price=num_var*price1;        
		var total_price_txt=total_price.number_format();
        var point = total_price/'100';
		$(t).parent().find("#total_price"+ct_id).val(total_price);
		$(t).parent().parent().find('.price').html(total_price_txt+"원" +"<br>"+ point +"마일리지");
        
		var len=$(t).parent().parent().parent().find("tr").length;
		var total_num=0;
		var total_price2=0;
		for(i=0;i<len;i++){
			var tr=$(t).parent().parent().parent().find("tr").eq(i);
			var num=parseInt(tr.find(".num .number_input").val());
			var totprice=parseInt(tr.find(".num .total_price_input").val());
			total_num+=num;
			total_price2+=totprice;
		}
        
		var total_num_txt=total_num.number_format();
		var total_price2_txt=total_price2.number_format();
        point = total_price2/'100';
       
        
		$(t).parent().parent().parent().parent().find("tfoot tr .num").html(total_num_txt);
		$(t).parent().parent().parent().parent().find("tfoot tr .price").html(total_price2_txt+"원");
        $("#total").html(total_price2_txt+"원");
        $("#point").html(point);
        $("#totdel").html(total_price2_txt+"원");
        
	}
	Number.prototype.number_format = function(round_decimal) {
		return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
	};
	function form_check(act) {
		var f = document.cart_list;
		if($("input[name^=ct_id]:checked").size() < 1) {
            if(act == "buy"){
                alert("하나이상을 선택하세요");
                return false;
            }
		}else{
            var ids="";    
            $("input[id^=ct_id]").each(function(){
                if($(this).is(":checked")==true){
                    var id = $(this).attr('id');
                    id = id.replace("ct_id","");
                    if(ids!=""){
                        ids = ids + "," + id;
                    }else{
                        ids = id;
                    }
                }
            })
            $("#ids").val(ids);
        }
		if (act == "delete"){
			f.act.value = act;
			$(f).attr("action",g5_url+"/page/mypage/cart_update.php");
			f.submit();
		}else if(act == "buy"){
			f.act.value = act;
			$(f).attr("action",g5_url+"/page/mypage/reserve_form.php?tab=form");
			f.submit();
		}else if(act == "more"){
            f.act.value = act;
			$(f).attr("action",g5_url+"/page/product.php?tab=product");
			f.submit();
        }
		return true;
	}
    
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>