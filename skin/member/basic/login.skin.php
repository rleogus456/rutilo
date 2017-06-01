<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
$member_id = get_cookie('ck_save_id');
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
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide06.jpg"; ?>" alt="" /></a></div>
		
	<?php
		}
	?>
	</div>
<div class="width-fixed">
      <section class="section03">
           <header>
               <h4>LOGIN</h4>
               <p>로그인 핫면 더욱 다양한 서비스를 이용하실 수 있습니다.</p>
           </header>
       </section>
    <div class="loing_Back">        
        <section class="login_section">
           <p>아이디 또는 비밀번호를 입력하신 후 로그인 버튼을 눌러주세요.</p>
            <div class="section01_content wrap">
                <div id="login_form">
                    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
                        <input type="hidden" name="url" value="<?php echo $login_url ?>">
                        <input type="hidden" name="regid" id="regid" value="" />
                        <label for="login_id" class="idLabel">아이디 </label>
                        <div class="login_id">
                           <input type="text" name="mb_id" id="login_id" required class="input02 " size="20" maxLength="20" value="<?php echo $member_id; ?>">
                        </div>
                        <label for="login_pw" class="pwLabel">비밀번호</label>
                        <div class="login_pw">
                            <input type="password" name="mb_password" id="login_pw" required class="input02" size="20" maxLength="20" >
                        </div>
                        <div class="login_chk">
<!--
                            <div class="bdr">
                                <input type="checkbox" name="auto_login" id="login_auto_login" class="check01">
                                <label for="login_auto_login" class="check01_label"></label>
                                <label for="login_auto_login">자동로그인</label>
                            </div>
-->
                            <div>
                                <input type="checkbox" name="id_save" id="id_save_login" class="check01" <?php echo $member_id?"checked":""; ?>>
                                <label for="id_save_login" class="check01_label"></label>
                                <label for="id_save_login">아이디저장</label>
                            </div>
                        </div>
                        <div style="text-align:center"><input type="submit" value="로그인" class="btn"></div>
                        
                    </form>
                    <div class="login_link">
                        <ul>
                           <li class="last">아직 회원이 아니신가요?<a href="<?php echo G5_BBS_URL ?>/register_form.php" class="btn">회원가입</a></li>
                            <li>아이디/비밀번호를 잊어버리셨나요?<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="btn">아이디 / 비밀번호찾기</a></li>                            
                        </ul>
                    </div>
                </div>
            </div>
        </section>
	</div>
</div>
<script>
$(function(){
	//getRegid
	try{
		var regId = window.android.getRegid();
		$("#regid").val(regId);
	}catch(err){
		var regId = undefined;
	}
});
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

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
function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->