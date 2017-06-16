<?php
include_once('../common.php');
include_once(G5_PATH.'/head.php');
	$back_url=G5_URL."/page//view.php";
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	if($is_member){
		$link="javascript:location.href='".G5_URL."/page/mypage/add_cart.php?id=".$id."&type=".$type."&number=1';";
	}else{
		$link="javascript:location.href='".G5_BBS_URL."/login.php?id=".$id."&type=".$type."';";
	}
$list=sql_fetch("select * from `rutilo_product` where id='".$id."'");
$point = $list['price'] / 100 ;
?>
	
<div class="width-fixed">
	<section class="section03">	
	<header></header>
		<article id="mall_view">
        	<div class="width-fixed">
                <div class="top">
                    <div class="img">
                        <div>
                            <img src="<?php echo G5_DATA_URL."/model/".$list['photo']; ?>" alt="image" />
                        </div>
                    </div>
                    <div class="txt">
                        <div class="info">
                            <div class="title">
                                <h2><?php echo $list['name']; ?></h2>
                                <h3><?php echo $list['content']; ?></h3>
                                <p>한번 코팅으로 3개월 지속, 변색된 휠러를 고유의 컬러로 복원시켜줍니다.</p>
                            </div>                            
                        </div>
                        <div class="price">
                            <h2>구성품 : <?php echo $list['components']; ?></h2>
                            <h2>판매가 : <?php echo $list['price']; ?>원</h2><br>
                            <h2>마일리지 : <?php echo $point;?> Point</h2>
                            <h2>배송비 : 4,000원</h2>                            
                        </div>
                        <div class="buy">                           
                            <div class="total">                              
                               <h2> 
                                    <div class="txt">주문수량</div>                              
                                    <div class="num">
                                        <input type="text" name="number" id="number" onkeyup="return num_enter(this);" data-max="10" required value="<?php echo $view['out'] || $view['number']-$view['sell']<=0?0:1; ?>" />
                                        <a href="javascript:number_minus();">-</a>
                                        <a href="javascript:number_plus();">+</a>
                                    </div>
                                    <div class="btn_group">
                                        <a class="btn02" href="<?php echo $link; ?>">바로구매</a>
                                        <a class="btn01" href="<?php echo $link; ?>">장바구니</a>
                                    </div>   
                               </h2>                              
                            </div>                                                      
                        </div>
                        <div id="view_header">
                             <ul class="mypageSubList">
                        <li class="cont conten">
                            <a href="">제품설명</a>
<!--
                            <ul class="subMenu">
                                <li>주문내역</li>
                                <li>주문배송조회</li>
                                <li>반품/교환</li>
                                <li>1:1 문의</li>
                            </ul>
-->
                        </li>
                        <li class="cont conten1"><a href="" >MSDS</a></li>
                        <li class="cont conten2"><a href="">지원정보</a></li>
                        
                    </ul> 
                        </div>
                    </div>
                </div>
            </div>
		</article>
	</section>	
</div>
<script>
    	function number_plus(){
		var price=$("#price").val();
		var max_num=$("#number").attr("data-max");
		var num_var=parseInt($("#number").val());
		var num_plus=num_var+1;
		if(max_num<num_plus){
			alert("더이상 수를 늘릴 수 없습니다.");
			return false;
		}
		$("#number").val(num_plus);
		var total=(num_plus*price).number_format();
		$("#mall_view .top .buy .total h4").html("<span>总价</span>$ "+total);
	}
	function number_minus(){
		var price=$("#price").val();
		var max_num=$("#number").attr("data-max");
		var num_var=parseInt($("#number").val());
		var num_minus=num_var-1;
		if(0>=num_minus){
			alert("더 이상의 수를 줄일 수 없습니다。");
			return false;
		}
		$("#number").val(num_minus);
		var total=(num_minus*price).number_format();
		$("#mall_view .top .buy .total h4").html("<span>总价</span>$ "+total);
	}
    function num_enter(t){
		number_only(t);
		var price=$("#price").val();
		var max_num=$("#number").attr("data-max");
		var num_var=parseInt($("#number").val());
		if($("#number").val()=="" || num_var<=0){
			alert("정확한 값이 아닙니다。");
			$("#number").val(1);
			num_var=1;
		}
		if(max_num<num_var){
			alert("더 이상의 수를 줄일 수 없습니다。");
			$("#number").val(max_num);
			num_var=max_num;
		}
		var total=(num_var*price).number_format();
		$("#mall_view .top .buy .total h4").html("<span>总价</span>$ "+total);
	}
	Number.prototype.number_format = function(round_decimal) {
		return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
	};
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
