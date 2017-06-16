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

$mb_name=$_POST['mb_name'];
$mb_phone=$_POST['mb_phone'];
$where="";
if($is_member){
    $where="r.mb_id='{$member['mb_id']}'";
}else{
    if(!$mb_name||!$mb_phone){
        goto_url(G5_URL."/page/mypage/reserve_nomember.php");
    }else{
        $where="r.mb_name='{$mb_name}' and r.mb_phone='{$mb_phone}'";
    }
}
if($is_admin){
    $query=sql_query("select r.*,m.name as name,m.photo as photo,m.components as components,r.datetime as datetime from `rutilo_reserve` as r left join `rutilo_product` as m on r.model=m.id  order by id desc");
}else{
    $query=sql_query("select r.*,m.name as name,m.photo as photo,m.components as components,r.datetime as datetime from `rutilo_reserve` as r left join `rutilo_product` as m on r.model=m.id where {$where} order by id desc");
}
while($data=sql_fetch_array($query)){
		$list[]=$data;
      
	}

?>
	
	<div class="width-fixed">
        <section class="section03" style="<?php if(!$is_member){ echo "margin-bottom:0" ;}?>">
            <header style="<?php if($is_member){echo "border-bottom:3px solid #ddd";}?>">
                <?php if($is_member){
                ?>
                <div id="mypage_header">
                      <div class="mypageBoderT">
                          <div class="mypage">
                              <h1>마이페이지</h1>

                              <ul class="mypageSub">
                                  <li class="cont">
                                      <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">개인정보수정</a>

                                      <ul class="subMenu menuLine">
                                          <!--<li><div class="menuLine"></div></li>-->
                                          <li><a href="<?php echo G5_URL."/page/mypage/orderHistory.php?tab=regform" ?>">주문내역</a></li>
                                          <li><a href="<?php echo G5_URL."/page/mypage/viewOrders.php?tab=regform" ?>">주문배송조회</a></li>
                                          <li><a href="<?php echo G5_URL."/page/mypage/viewReturn.php?tab=regform" ?>">반품/교환</a></li>
                                          <li><a href="<?php echo G5_URL; ?>">1:1 문의</a></li>
                                      </ul>
                                  </li>
                                  <li><a href="<?php echo G5_BBS_URL."/member_confirm.php?tab=form"?>" >회원탈퇴</a></li>
                              </ul>
                          </div>
                          <div class="mypageUser">
                            <div class="mypageImg"><img src="<?php echo G5_IMG_URL."/mypage_profile.jpg" ?>" alt="profile"></div>
                            <div>
                                 <div class="mypageList">
                                     <h2><?php echo $member['mb_name']; ?> 님</h2>
                                     <p>회원님의 정보를 확인 할 수 있습니다.</p>
                                 </div>
                                 <ul class="mypageSubList1">
                                    <li class="cont tab"><a href="">마일리지 <span><?php echo $member['mb_point']; ?></span>P</a></li>
                                    <li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
                                </ul>
                            </div>
                          </div>
                        </div>        
                     </div>
                 </div>	
                <?php }else{ ?>
                <h4><?php echo "회원가입"; ?></h4>
                <p><?php echo "루틸로에 오신것을 환영합니다."; ?></p>
                <?php }?>
            </header>
        </section>

<section class="section03">
    
	<article id="mall_buy" class="wrap">		
		<div class="width-fixed">
			<form action="<?php echo G5_URL."/page/mypage/order_form.php"; ?>" method="post" name="cart_list" id="cart_list">
				<input type="hidden" name="act" value="" />
				<input type="hidden" name="ids" id="ids" />
				<div class="price_info" id="cart">
                 	<section class="section03" style="margin-bottom:0">
					 <div class="form_list01">                
                    <h2>반품/교환 현황</h2>
                     <p class="mypageP" style="float:none;padding:0 30px 30px 30px;margin:0" ><span>> </span>교환/반품 신청은 배송완료 후 7일이내 가능합니다. <br>
                     <span>> </span>변심 반품의 경우 왕복배송비를 차감한 금액이 환불되며, 제품 및 포장 상태가 재판매 가능하여야 합니다.</p>					    
                    </div>
					<table>
						<thead>
							<tr>								
								<th class="code mobile">주문번호</th>
								<th class="code mobile">주문일자</th>
								<th class="info">제품정보</th>
								<th class="price">주문금액</th>
								<th class="num">결제방식</th>
								<th class="price">입금확인</th>
								<th class="price">주문상태</th>
							</tr>
						</thead>
						<tbody>
						<?php				
						for($i=0;$i<count($list);$i++){		
                              $count = count(explode(",",$list[$i]["model"]))-1;      
                            switch($list[$i]['status']){
							case"-1":$status="<span class='cancle'>주문취소</span>";break;
							case"0":$status="<span class='waiting'>주문완료</span>";break;
							case"1":$status="<span class='ing'>결제대기</span>";break;
							case"2":$status="<span class='end'>결제완료</span>";break;
							default:$status="<span class='waiting'>배송준비중</span>";break;
						}
                            sql_query("update `rutilo_cart` set `price`='{$price}' where `id` = '{$list[$i]['id']}'");
						?>
							<tr<?php echo $out?" class='out'":""; ?>>								
								<td class="code mobile"><?php echo $list[$i]['code']; ?></td>
								<?php $str = explode(":",$list[$i]['datetime']); ?>
								<td class="code mobile"><?php echo $str[0]; ?></td>
								<td class="info">
								<a href="<?php echo G5_URL."/page/view.php?id=".$list[$i]['model']; ?>" target="_blank">
									<div>
										
										<div class="title">
<!--											<h4><?php echo str_replace("|","/",$list[$i]['type']); ?></h4>-->
											<h3><?php echo $list[$i]['name']; if($count>1){ echo " 외 ",$count-1,"종";} ?></h3>
											<?php for($j=0 ; $j<$count; $j++){ ?>
											<p>[ <?php echo $list[$i]['components']; ?> ]</p>
											<?php } ?>
										</div>
									</div>
                                    </a>
								</td>
								<td class="price">
									 <?php echo $list[$i]['price']; ?>원
								</td>
								<td class="price">
									 <?php echo $list[$i]['payment'];?> 
								</td>
								<td class="price" style="<?php if($list[$i]['status']==0){echo "color:#fe1e1e";} ?>">
									 <?php if($list[$i]['status']==2){
                                        echo "입금완료";
                                        }elseif($list[$i]['status']==0){
                                        echo "입금대기중";
                                        }?>
								</td>
                                <td class="price">
									 <?php echo $status?> 
								</td>								
							</tr>
						<?php }
                       
						if(count($list)<=0){
						?>
						<tr>
							<td colspan="7">주문목록이 없습니다.</td>
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
                    <section class="section03">	   
                    <input type="hidden" name="model" id="model" value="<?php echo $proid; ?>" />  
                    <input type="hidden" name="mb_id"id="mb_id" value="<?php echo $member['mb_id']; ?>" />
                    <input type="hidden" name="price" id="price" value="<?php echo $total_price;?>" />
                    <input type="hidden" readonly name="number" id="number" value="<?php echo $num1; ?>"/>	 
			</form>
		</div>
	</article>
</section>
</div>

<?php
include_once(G5_PATH.'/tail.php');
?>