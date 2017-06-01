<?php
include_once('../common.php');
include_once(G5_PATH.'/head.php');
?>
	<div id="main_event" class="owl-carousel">
	<?php
		for($i=0;$i<count($event_list);$i++){
			$thumb = get_list_thumbnail("event", $event_list[$i]['wr_id'], 1100, 464);
			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
			}
			if($img_content){
	?>
		<div class="item"><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$event_list[$i]['wr_id']; ?>"><?php echo $img_content; ?></a></div>
	<?php
			}
		}
		if(count($event_list)<=0){
	?>
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide03.jpg"; ?>" alt="" /></a></div>
		
	<?php
		}
	?>
	</div>

<div class="width-fixed">
	<section class="section03">	
<!--
		<header>
			<h4>Rutilo</h4>
            <p>새차처럼 보호와 코팅을 한번에!!</p>
		</header>		
-->
		<article id="mall_view">
        	<div class="width-fixed">
                <div class="top">
                    <div class="img">
                        <div>
                            <img src="<?php echo G5_IMG_URL."/rutilo101.jpg"; ?>" alt="" />
                        </div>
                    </div>
                    <div class="txt">
                        <div class="info">
                            <div class="title">
                                <h2>루틸로 No 101</h2>
                                <h3>프리미엄 자동차 코팅제 all in one</h3>
                                <p>한번 코팅으로 3개월 지속, 변색된 휠러를 고유의 컬러로 복원시켜줍니다.</p>
                            </div>                            
                        </div>
                        <div class="price">
                            <h2>구성품 : 루틸로 101 250ml + 극세사 타월</h2>
                            <h2>판매가 : 32000원</h2>
                            <h2>마일리지 : 110 Point</h2>
                            <h2>배송비 : 4,000원</h2>
                            
                        </div>
                        <div class="buy">                           
                            <div class="total">                              
                               <h2> 
                                    <div class="txt">주문수량</div>                              
                                    <div class="num">
                                        <input type="text" name="number" id="number" onkeyup="return num_enter(this);" data-max="<?php echo $view['out']?0:$view['number']-$view['sell']; ?>" required value="<?php echo $view['out'] || $view['number']-$view['sell']<=0?0:1; ?>" />
                                        <a href="javascript:number_minus();">-</a>
                                        <a href="javascript:number_plus();">+</a>
                                    </div>
                                    <div class="btn_group">
                                        <a class="btn02" href="<?php echo G5_BBS_URL."/login.php?url=".urlencode($url); ?>">바로구매</a>
                                        <a class="btn01" href="<?php echo G5_BBS_URL."/login.php?url=".urlencode($url); ?>">장바구니</a>
                                    </div>   
                               </h2>
                              
                            </div>
                                                      
                        </div>
                    </div>
                </div>
            </div>
         
<!--
        <h4 class="intro">루틸로를 방문해주셔서 감사합니다.</h4>
        <p>루틸로는 세계 최초 하이브리드 코팅제로, 순수 국내 기술로 개발된 루틸로 코팅제는 우수한 방수/방오 성능으로 자동차 도장면은 물론 플라스틱과 고무, 유리, 가죽, 신발, 섬유 등 일상의 모든곳에 사용할 수 있습니다.</p>
-->
          
		</article>
	</section>	
</div>
<script>
$(function(){
		var owl1=$("#main_event");		
		owl1.owlCarousel({
			animateOut: 'fadeOut',
			autoplay:true,
			autoplayTimeout:5000,
			autoplaySpeed:2000,
			smartSpeed:2000,
			loop:true,
			dots:true,
            nav:true,
            navText: [ '', '' ],
            items:1
		});	
		setTimeout(function(){main_notice_slide()},5000);
		var n=0;
		var main_notice_len=$("#main_notice li").length;
		/* 메인배너 슬라이드 */
		function main_notice_slide(act,roop){
			n++;
			if(n>=main_notice_len){
				n=0;
			}
			go=n * -46;
			$("#main_notice ul").animate(
				{'margin-top': go+'px'}
			);
			setTimeout(function(){main_notice_slide()},5000);
		}
	});</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
