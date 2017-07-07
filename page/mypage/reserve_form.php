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
		<h4>주문확인</h4>
		    <p>루틸로에 오신 것을 환영 합니다.</p>
		    <div class="width-fixed">
		        <nav class="section03_nav">
                    <ul class="list3">
                        <li style="width:28%"><a><span class="texts">STEP 01</span> <br>장바구니</a></li>
                        <li style="width: 5%;vertical-align: top;padding-top:5px"><img src="../../img/section03_navImg.jpg" alt=""></li>
                        <li class="active" style="width:28%"><a><span class="texts">STEP 02</span> <br>주문결제</a></li>
                        <li style="width: 5%;vertical-align: top;padding-top:5px"><img src="../../img/section03_navImg.jpg" alt=""></li>
                        <li style="width:28%"><a><span class="texts">STEP 03</span> <br>주문완료</a></li>
                        
            <!--			<li style="width:20%"><a style="padding: 15px;"><span class="texts">STEP 05</span> <br>가입완료</a></li>-->
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
								<th class="code">주문번호</th>
								<th class="info">제품정보</th>
								<th class="num">수량</th>
								<th class="price">가격/<br>마일리지</th>
								
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
<!--											<h4><?php echo str_replace("|","/",$list[$i]['type']); ?></h4>-->
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
								<td class="price">
									 <?php echo number_format(ceil($price),0); ?>원 <br> <?php  echo $price/100; ?> 마일리지
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
                    <section class="section03">	   
                    <input type="hidden" name="model" id="model" value="<?php echo $proid; ?>" />  
                    <input type="hidden" name="mb_id"id="mb_id" value="<?php echo $member['mb_id']; ?>" />
                    <input type="hidden" name="price" id="price" value="<?php echo $total_price;?>" />
                    <input type="hidden" readonly name="number" id="number" value="<?php echo $num1; ?>"/>	 
                    	     
					<div class="form_list01">
					    <h2>주문고객정보</h2>
					    
<!--
					    <p class="mypageP"><span>> </span><?php echo $member['mb_name'];?>님의 회원가입 정보입니다.<br>
					    <span>> </span>등록된 회원정보를 확인하시고 변경된 정보가 있으시면 수정해 주시기 바랍니다.</p>					    
-->
						<ul class="borderFirst">
											
						<ul style="border-top:none">
							<li>
								<div>
									<label for="reg_mb_name">보내시는 분</label>
									<div>
										<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
										<p id="msg_mb_id" class="inputMsg"></p>									
									</div>								
								</div>								
							</li>
                            <li>
								<div>
									<label for="reg_mb_hp">전화번호</label>
									<div>
										<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> onkeyup="return number_only(this);" class="input01" maxlength="20">
									</div>
									<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
										<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
									<?php } ?>
								</div>								
							</li>						
							<li>
							    <div>
									<label for="reg_mb_email">이메일</label>								
									<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
									<div>
									<input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="input03" maxlength="100"> @ &nbsp;
<!--									<input type="text" name="mb_email2" value="<?php echo isset($member['mb_email2'])?$member['mb_email2']:''; ?>" id="reg_mb_email2" required class="input03" maxlength="100">-->
									<select class="input03" name="mb_email2" id="reg_mb_email2" style="padding:0px">
                                        <option value="">선택해주세요</option>
                                        <option value="naver.com">naver.com</option>
                                        <option value="hanmail.net">hanmail.net</option>
                                        <option value="hotmail.net">hotmail.net</option>
                                        <option value="gmail.com">gmail.com</option>
                                        <option value="nate.com">nate.com</option>
                                        <option value="yahoo.com">yahoo.com</option>
							         </select>
							         
									</div>
								</div>
							</li>
                           <li>
								<div>
									<label for="reg_mb_addr2">주소</label>
									<div>
										<input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_postcode5 input01" minlength="3" maxlength="20">
										<input type="button" class="btn_submit" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989"><br>
										<input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="reg_mb_addr2" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_address input01 addrD" minlength="3" maxlength="100">
										<input type="text" name="mb_addr3" value="<?php echo $member['mb_addr3'] ?>" id="reg_mb_addr3" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_details input01 addrD" minlength="3" maxlength="100" placeholder="상세주소">
										<span id="msg_mb_name"></span>
									</div>
								</div>
							</li>
                        </ul>
                    </ul>
                    
                    </div>
                    <div class="form_list01">
					    <div>
                            <h2>배송지정보</h2>
					        <input type="radio" name="delivery_chk" id="delivery_chk" class="input01">주문자정보와 동일
                            <input type="radio" name="delivery_chk" id="delivery_chk2"class="input01">새로운 주소지
					    </div>
					    
<!--
					    <p class="mypageP"><span>> </span><?php echo $member['mb_name'];?>님의 회원가입 정보입니다.<br>
					    <span>> </span>등록된 회원정보를 확인하시고 변경된 정보가 있으시면 수정해 주시기 바랍니다.</p>					    
-->
						<ul class="borderFirst">
										
						<ul style="border-top:none">
							<li>
								<div>
									<label for="reg_mb_name2">받으시는 분</label>
									<div>
										<input type="text" name="mb_name2" id="reg_mb_name2" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
										<p id="msg_mb_id" class="inputMsg"></p>									
									</div>								
								</div>								
							</li>
                            <li>
								<div>
									<label for="reg_mb_hp">전화번호</label>
									<div>
										<input type="text" name="mb_hp2" id="reg_mb_hp2" <?php echo ($config['cf_req_hp'])?"required":""; ?> onkeyup="return number_only(this);" class="input01" maxlength="20">
									</div>
									<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
										<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
									<?php } ?>
								</div>								
							</li>
                           <li>
								<div>
									<label for="reg_mb_addr2">주소</label>							
									<div>
										<input type="text" name="mb_addr4"  id="reg_mb_addr4" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_postcode5 input01" minlength="3" maxlength="20">
										<input type="button" class="btn_submit" id="postcodify_search_button" value="우편번호 찾기" style="background:#898989"><br>
										<input type="text" name="mb_addr5"  id="reg_mb_addr5" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_address input01 addrD" minlength="3" maxlength="100">
										<input type="text" name="mb_addr6"  id="reg_mb_addr6" <?php echo $required ?> <?php echo $readonly ?> class="postcodify_details input01 addrD" minlength="3" maxlength="100" placeholder="상세주소">
										<span id="msg_mb_name"></span>
									</div>
								</div>
							</li>
                           <li>
								<div>
									<label for="reg_mb_requested">배송요청사항</label>
									<div>
										<input type="text" name="mb_requested" id="reg_mb_requested" <?php echo ($config['cf_req_hp'])?"required":""; ?>  class="input01 addrD" maxlength="20">
										<p id="msg_mb_id" class="inputMsg" style="float:none"><span>*</span> 주문시 요청사항은 배송기사가 배송시 참고하는 사항으로써, 사전에 협의되지 않은 지정일 배송 등의 요청사항은 반영되지 않을 수 있습니다.</p>									
									</div>
									<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
										<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
									<?php } ?>
								</div>								
							</li>
                        </ul>
                    </ul>
                     <div class="form_list01">
					    <h2>할인정보</h2>
					    
<!--
					    <p class="mypageP"><span>> </span><?php echo $member['mb_name'];?>님의 회원가입 정보입니다.<br>
					    <span>> </span>등록된 회원정보를 확인하시고 변경된 정보가 있으시면 수정해 주시기 바랍니다.</p>					    
-->
						<ul class="borderFirst">
											
						<ul style="border-top:none">
							<li>
								<div>
									<label for="reg_mb_id">마일리지 사용</label>
									<div>
										<input type="text" name="mb_point" id="mb_point" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
										<p id="msg_mb_id" class="inputMsg"><span>*</span> 마일리지는 상품금액 000원 이상 결제시 사용 가능합니다.</p>	
										<input type="button" class="btn_submit" id="btnclick04" value="사용" style="background:#898989"/>								
									</div>								
								</div>								
							</li>
                            </ul>
                         </ul>
                        </div>
                        <div class="form_list01">
					    <h2>결제수단</h2>
					    
<!--
					    <p class="mypageP"><span>> </span><?php echo $member['mb_name'];?>님의 회원가입 정보입니다.<br>
					    <span>> </span>등록된 회원정보를 확인하시고 변경된 정보가 있으시면 수정해 주시기 바랍니다.</p>					    
-->
						<ul class="borderFirst">											
						<ul style="border-top:none">
							<li>
								<div>									
									<div>										
                                        <input type="radio" name="chk_info" value="신용카드" checked="checked" class="input01">신용카드
                                        <input type="radio" name="chk_info" value="실시간 계좌이체" class="input01">실시간 계좌이체
                                        <input type="radio" name="chk_info" value="무통장 입금" class="input01">무통장 입금
                                        <p style="float:none">신용카드 결제 시 화면 아래 "결제하기" 버튼을 클릭하면 신용카드 결제 창이 나타납니다. <br>
                                        신용카드/실시간 계좌이체는 결제 후 , 무통장입금은 입금확인 후 배송이 이루어집니다.</p>
									</div>								
								</div>								
							</li>
                            </ul>
                         </ul>
                        </div>
                    </div>
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
					        <h2>결제예정금액 <span class="text-r"><?php echo $total_price ;?>원</span></h2>
					    </div>
					</div>			
				</div>		
				<div class="btn_group01">
					<input style="background-color:#fff" type="button" value="이전단계" class="btn1 grid_30" onclick="return form_check('back');" />
					<input  type="button" value="결제하기" class="btn grid_30" onclick="return form_check('buy');" />
				</div>
			</form>
		</div>
	</article>
</section>

<script type="text/javascript">  
    
  $(function() 
  { 
    $("#delivery_chk").click(function(){
        $("#reg_mb_name2").val($("#reg_mb_name").val());
        $("#reg_mb_hp2").val($("#reg_mb_hp").val());
        $("#reg_mb_addr4").val($("#reg_mb_addr1").val());
        $("#reg_mb_addr5").val($("#reg_mb_addr2").val());
        $("#reg_mb_addr6").val($("#reg_mb_addr3").val());
        $('#reg_mb_requested').focus();
    })
    $("#delivery_chk2").click(function(){
        $("#reg_mb_name2").val("");
        $("#reg_mb_hp2").val("");
        $("#reg_mb_addr4").val("");
        $("#reg_mb_addr5").val("");
        $("#reg_mb_addr6").val("");
         $("#reg_mb_id2").focus();
    })
  });  
  $(function() 
  { 
    $("#postcodify_search_button").postcodifyPopUp(); 
  });
  
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