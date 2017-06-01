<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style type="text/css">
	.section01_header .password_lost_head{width:386px;height:45px;background-image:url("../img/password_lost_head.png");background-repeat:no-repeat;background-position:top left;}
	#password_lost{display:table;width:100%;}
	#password_lost > div{float:left;width:100%;box-sizing:border-box;background:#fff;border:1px solid #ddd;}
	#password_lost > div.mr{margin-right:36px;}
	#password_lost > div header{padding:26px 22px;border-bottom:2px solid #fe1e1e;letter-spacing:-0.07em;}
	#password_lost > div header h2{font-size:24px;font-family:nbgr;font-weight:normal;margin-bottom:5px;}
	#password_lost > div header p{font-size:14px;color:#737373;}
	#password_lost > div > div{padding:40px 18px;}
	#password_lost > div > div .btn{margin-top:12px;font-size:20px;letter-spacing:-0.02em;font-family:nbgr;height:50px;border:1px solid #f1bdbf;box-shadow:2px 2px 0 #b9b9b9;background:#fe1e1e;color:#fff;}
	@media all and (max-width: 1120px){
		#password_lost{display:block;box-sizing:border-box;}
		#password_lost > div{float:none;width:100%;}
		#password_lost > div.mr{margin-right:0;margin-bottom:20px;}
	}
	@media all and (max-width: 786px){
		#password_lost > div header{padding:20px 15px;}
		#password_lost > div header h2{font-size:18px;margin-bottom:3px;}
		#password_lost > div > div{padding:20px 15px;}
		#password_lost > div > div .btn{height:40px;font-size:16px;box-shadow:1px 1px 0 #b9b9b9;}
	}
	@media all and (max-width: 480px){
		#password_lost > div header{padding:15px;}
		#password_lost > div header h2{font-size:16px;margin-bottom:0;}
		#password_lost > div header p{font-size:12px;}
		#password_lost > div > div{padding:15px;}
		#password_lost > div > div .btn{font-size:16px;box-shadow:1px 1px 0 #b9b9b9;margin-top:5px;}
	}
</style>
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
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide06.jpg"; ?>" alt="" /></a></div>
		
	<?php
		}
	?>
	</div>
<div class="width-fixed">
	<section class="section03" style="margin-bottom:0px">
	    <header>
			<h4>아이디</h4>
			<p>회원 정보에 저장된 휴대폰/전화번호/이메일 주소로 아이디를 찾을 수 있습니다.</p>
		</header>
	</section>		
		<section class="section01">
		<div class="section01_content wrap" id="password_lost">
			<div class="mr">
				<header>
					<h2>아이디 찾기</h2>
					<p>회원가입 시 등록하신 휴대폰번호를 입력하세요.</p>
				</header>
				<div>
					<form name="idlost" action="#" onsubmit="return idlost_submit(this);" method="post" autocomplete="off">
						<input type="text" name="mb_hp" id="mb_hp" required class="input02 grid_100" onkeyup="return number_only(this);" placeholder="휴대폰번호(-없이 입력)" />
						<input type="submit" value="아이디 찾기" class="btn grid_100">
					</form>
				</div>
			</div>
           </div>
            </section>
            
    <section class="section03" style="margin-bottom:0px">
	    <header>
			<h4>비밀번호 찾기</h4>
			<p>본인인증을 완료한 회원님은 이메일, 휴대폰을 이용하여 비밀번호를 찾으실 수 있습니다. <br> 아이디가 확인되면 임시비밀번호를 보내드립니다. 로그인 후 마이페이지 > 개인정보수정에서 비밀번호를 수정해주세요.</p>
		</header>
	</section>
        <section class="section01">
        <div class="section01_content wrap" id="password_lost">
        <div>
				<header>
					<h2>비밀번호 찾기</h2>
					<p>회원가입 시 등록하신 이메일을 입력하세요.</p>
				</header>
				<div>
					<form name="pwlost" action="#" onsubmit="return pwlost_submit(this);" method="post" autocomplete="off">
						<input type="text" name="mb_email" id="mb_email" required class="input02 grid_100" size="30"placeholder="이메일주소 입력" />
						<input type="submit" value="비밀번호 찾기" class="btn grid_100">
					</form>
				</div>
			</div>
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
function idlost_submit(f){
	var mb_hp=$("#mb_hp").val();
	$.post(g5_url+"/page/modal/idlost.php",{mb_hp:mb_hp},function(data){
		$(".msg").html(data);
		msg_active();
	});
    return false;
}
function pwlost_submit(f){
	var mb_email=$("#mb_email").val();
	$.post(g5_bbs_url+"/password_lost2.php",{mb_email:mb_email},function(data){
		$(".msg").html(data);
		msg_active();
	});
    return false;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->