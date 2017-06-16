<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
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
            if($is_member){
	?>	    
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide07.jpg"; ?>" alt="" /></a></div>		
	<?php
		}else{?>
               <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide06.jpg"; ?>" alt="" /></a></div>
        <?php        
            }}
	?>
	</div>
<div class="width-fixed">
	<section class="section03">
		<header>
			<h4>회원탈퇴 완료</h4>
			<h3 class="member_leave_head"></h3>
			<p>그동안 루틸로를 이용해주셔서 감사합니다.</p>
		</header>	
		<div class="loing_Back">
		<section class="login_section">
		<div class="section01_content wrap" id="register_result">
			<i></i>
			<h1>회원탈퇴가 완료되었습니다!</h1>
			<p>
				그동안 루틸로를 이용해주셔서 감사하며<br />
				더 나은 서비스로 돌아오도록 하겠습니다.
			</p>
			<a href="<?php echo G5_URL; ?>" class="btn">HOME</a>
		</div>
	</section>
        </div>
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
			loop:false,
			dots:false,
            nav:true,
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
	});
</script>