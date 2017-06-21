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
print_r($_REQUEST);
if($is_member)
	$where="`mb_id`='{$member['mb_id']}'";
else
	$where="`mb_ip`='{$_SERVER['REMOTE_ADDR']}' and `mb_session`='{$cart_session}' and `mb_id`='' and c.`datetime`>'{$date1}'";

$sql="select *,c.id as id,c.number as number,p.photo as photo,p.photolink as photo2 from `rutilo_cart` as c inner join `rutilo_product` as p on c.product_id=p.id where {$where} and od_status='0' order by c.datetime desc";
$query=sql_query($sql);
while($data=sql_fetch_array($query)){
	$list[]=$data;
}
$view=sql_fetch("select * from `rutilo_reserve` where id='{$id}'");
$view1=sql_fetch("select * from `rutilo_delivery` where id='{$id}'");

?>
	
<section class="section03">
    <header>
		<h4>주문완료</h4>		    
		    <div class="width-fixed">
		        <nav class="section03_nav">
                    <ul class="list3">
                        <li style="width:28%"><a><span class="texts">STEP 01</span> <br>장바구니</a></li>
                        <li style="width: 5%;vertical-align: top;padding-top:5px"><img src="../../img/section03_navImg.jpg" alt=""></li>
                        <li style="width:28%"><a><span class="texts">STEP 02</span> <br>주문결제</a></li>
                        <li style="width: 5%;vertical-align: top;padding-top:5px"><img src="../../img/section03_navImg.jpg" alt=""></li>
                        <li  class="active" style="width:28%"><a><span class="texts">STEP 03</span> <br>주문완료</a></li>
                        
            <!--			<li style="width:20%"><a style="padding: 15px;"><span class="texts">STEP 05</span> <br>가입완료</a></li>-->
                    </ul>
                </nav>  
            <div class="result">
		        <h3>주문이 정상적으로 완료 되었습니다.</h3>
		        <div class="resultTxt">
		            <h4>[주문번호] 20170525102055 [입금은행] 국민 882801-00-026364</h4>
		        </div>
		        <p>주문내역 및 배송에 관한 안내는 <span class="red">마이페이지 > 주문내역/배송조회</span>에서 확인 가능합니다. <br> 현금영수증, 신용카드 매충전표 등 증빙서류발급은 주문 완료 후 <span class="red">마이페이지 > 증빙서류발급</span>에서 가능합니다.</p>
		    </div>
		    </div>
		    
		 
		</header>
 
	<article id="mall_buy" class="wrap">		
		<div class="width-fixed">
			<form action="<?php echo G5_URL."/page/mypage/order_form.php"; ?>" method="post" name="cart_list" id="cart_list">
				<input type="hidden" name="act" value="" />
				<input type="hidden" name="ids" id="ids" />				
				<div class="price_info" id="cart">
				<section class="section03" style="margin-bottom:0">
				    	<div class="form_list01">
					    <h2>결제 정보 확인</h2>
						<table class="infoT">
                            <tr>
                                <th>결제방법</th>
                                <td><?php echo $view['payment']; ?></td>
                                <th>주문일시</th>
                                <td><?php echo $view['datetime']; ?></td>
                            </tr>                        
						    <tr>
						        <th>입금 예금자명</th>
						        <td><?php echo $view['mb_name'];?></td>
						        <th>입금 은행 가상계좌</th>						        
						        <td><?php echo $view['mb_email'];?></td>
						    </tr>
						    <tr>
						        <th>결제하실 금액</th>
						        <td colspan="3" style="color:#fe1e1e"><?php echo $view['price']; ?>원</td>						        
						    </tr>
						</table>                                     
                    </div>
				    <div class="form_list01">                
                    <h2>주문 리스트 확인</h2>
                    </div>
					<table>
						<thead>
							<tr>
								<th class="check"><input type="checkbox" name="all" id="all" onchange="if (this.checked) all_checked(true); else all_checked(false);" checked /></th>
								<th class="code">주문번호</th>
								<th class="info">제품정보</th>
								<th class="num">수량</th>
								<th class="price">판매가격</th>	
								<th class="point mobile">마일리지</th>								
							</tr>
						</thead>
						<tbody>
						<?php
						$total_num=0;
						$total_price=0;
                        $delivery = '4000';
						for($i=0;$i<count($list);$i++){
							$out=false;
                            $proid .= $list[$i]['product_id'].",";
                            $num1 .=$list[$i]['number'].",";
							$number=$list[$i]['number'];	
                             $price=$list[$i]['price'];
                             $price=$list[$i]['price']*$number;
					        $total_num+=$number;
							$total_price+=$price;                            
                            sql_query("update `rutilo_cart` set `price`='{$price}' where `id` = '{$list[$i]['id']}'");
						?>
							<tr<?php echo $out?" class='out'":""; ?>>
								<td class="check"><input type="checkbox" name="ct_id[]" id="ct_id<?php echo $list[$i]['id']; ?>"onClick="chkboxClick(this)" value="<?php echo $list[$i]['id']; ?>" <?php echo $out?"":"checked"; ?> /></td>
								<td class="code"><?php echo $list[$i]['code']; ?></td>
								<td class="info">
								<a href="<?php echo G5_URL."/page/view.php?id=".$list[$i]['product_id']; ?>" target="_blank">
									<div>
										<div class="img"><div><div><img src="<?php if($list[$i]['photo']){ echo G5_DATA_URL."/model/".$list[$i]['photo'];}else{echo $list[$i]['photo2'];} ?>" alt="<?php echo $list[$i]['name']; ?>" /></div></div></div>
										<div class="title">
											<h3><?php echo $list[$i]['name']; ?></h3>
											<p>[ <?php echo $list[$i]['components']; ?> ]</p>
										</div>
									</div>
                                    </a>
								</td>
								<td class="num">
									<input type="text" name="number[]" id="number<?php echo $list[$i]['id']; ?>" value="<?php echo $list[$i]['number']; ?>" readonly class="number_input" onblur="num_enter(this);" data-max="<?php echo $list[$i]['out']?0:$list[$i]['total']-$list[$i]['sell']; ?>" data-id="<?php echo $list[$i]['id']; ?>" />
									<input type="hidden" name="price[]" id="price<?php echo $list[$i]['id']; ?>" value="<?php echo $list[$i]['price']; ?>" class="price_input" />
									<input type="hidden" name="total_price[]" id="total_price<?php echo $list[$i]['id']; ?>" value="<?php echo ceil($price); ?>" class="total_price_input" />
								</td>
								<td class="price" style="color:#fe1e1e">
									 <?php echo number_format(ceil($price),0); ?>원
								</td>
								<td class="point mobile">
								    <?php  echo $price/100; ?> Point 
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
                    </section>
                   <div class="cartInfo">
					    <h2>총 주문금액</h2>
					    <div class="price">
					        <h2>상품 총 금액 <span class="text-r" id="total"><?php echo $total_price;?>원</span></h2>					        
					    </div>
					    
					    <div class="delivery">
					        <h2>배송료 <span class="text-r"><?php echo $delivery; ?>원</span></h2>
					    </div>
					    <div class="line"></div>
<!--
					    <?php  if($total_price < '50000' ){
                            $total_price = $total_price + $delivery;
                        } ?>
-->
					    <div class="tot_price">
                            <p class="point">(적립마일리지 <span id="point"><?php echo $total_price/'100'; ?></span>P)</p>
					        <h2>결제예정금액 <span class="text-r" style="color:#fe1e1e"><?php echo $total_price ;?>원</span></h2>
					    </div>
					</div>	                   
                    <section class="section03">	   
                    <input type="hidden" name="model" id="model" value="<?php echo $proid; ?>" />  
                    <input type="hidden" name="mb_id"id="mb_id" value="<?php echo $member['mb_id']; ?>" />
                    <input type="hidden" name="price" id="price" value="<?php echo $total_price;?>" />
                    <input type="hidden" readonly name="number" id="number" value="<?php echo $num1; ?>"/>	      
					<div class="form_list01">
					    <h2>주문고객정보 확인</h2>
						<table class="infoT">              
						    <tr>
						        <th>보내시는 분</th>
						        <td><?php echo $view['mb_name'];?></td>
						        <th>이메일</th>						        
						        <td><?php echo $view['mb_email'];?></td>
						    </tr>
						    <tr>
						        <th>휴대폰</th>
						        <td><?php echo $view['mb_phone']; ?></td>
						        <th>전화번호</th>
						        <td><?php echo $view['mb_phone']; ?></td>
						    </tr>
						</table>                                     
                    </div>
                    
                    
                    <div class="form_list01">					    
                        <h2>결제 정보 확인</h2>					       
				    <table class="infoT">
				        <tr>
				            <th>받으시는 분</th>
				            <td><?php echo $view1["mb_id"];?></td>
				            <th>전화번호</th>
				            <td><?php echo $view1["mb_phone"];?></td>
				        </tr>
				        <tr>
				            <th>휴대폰번호</th>
				            <td colspan="3"><?php echo $view1["mb_phone"];?></td>
				        </tr>
				        <tr>
				            <th>주소</th>
				            <td colspan="3"><?php echo $view1["mb_addr"]; ?></td>
				        </tr>
				        <tr>
				            <th>배송 주의사항</th>
				            <td colspan="3"><?php echo $view1['requested']; ?></td>
				        </tr>
				    </table>
                    </div>
 				
				</div>		
				<div class="btn_group01">
					<input style="background-color:#fff" type="button" value="이전단계" class="btn1 grid_30" onclick="return form_check('back');" />
					<input style="background-color:#87001f  " type="button" value="인쇄하기" class="btn grid_30" onclick="return form_check('back');" />
					<input  type="button" value="결제하기" class="btn grid_30" onclick="return form_check('buy');" />
				</div>
			</form>
		</div>
	</article>
</section>
<script type="text/javascript">  
 
	
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
		if (act == "back"){
			f.act.value = act;
			$(f).attr("action",g5_url+"/page/mypage/cart.php");
			f.submit();
		}else if(act == "buy"){
			f.act.value = act;
			$(f).attr("action",g5_url+"/page/mypage/reserve_update.php");
			f.submit();
		}else if(act == "more"){
            f.act.value = act;
			$(f).attr("action",g5_url+"/page/mypage/list.php?type=short&mtype=");
			f.submit();
        }
		return true;
	}
    
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>