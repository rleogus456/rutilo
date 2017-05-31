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
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide02.jpg"; ?>" alt="" /></a></div>
		
	<?php
		}
	?>
	</div>

<div class="width-fixed">
	<section class="section03">	
		<header>

			<h4>트레이너 과정</h4>
<!--            <p>최고의 품질 최고의 성능으로 항상 최선을 다하는 루틸로 입니다.</p>-->

		</header>
		
		<article class="intro">
          <div class="introImg">
           <img src="<?php echo G5_IMG_URL."/intro.jpg"; ?>">
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
