<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
$register_action_url = G5_BBS_URL."/member_leave.php";
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js"></script>
<?php } ?>
	
<div class="width-fixed">
<section class="section03" >
    <header style="<?php if($is_member){echo "border-bottom:3px solid #ddd";}?>">
        <?php if($is_member){?>
        <div id="mypage_header">		
            <div class="width-fixed">
              <div class="mypageBoderT">
               <div class="mypage">
                  <h1>마이페이지</h1>
                  </div>
                   <div class="mypageImg"><img src="<?php echo G5_IMG_URL."/mypage_profile.jpg" ?>" alt="profile"></div>            
                    <div class="mypageList">
                    <ul>
                        <li><p><?php echo $member['mb_name']; ?> 님</p></li>
                        <li class="disPb">회원님의 정보를 확인 할 수 있습니다.</li>                       
                    </ul>                                  
                    </div>
                    <ul class="mypageSubList">
                        <li class="cont">
                            <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">개인정보수정</a>
                            <ul class="subMenu">
                               <div class="menuLine1"></div>
                          <li><a href="<?php echo G5_URL."/page/mypage/orderHistory.php?tab=regform" ?>">주문내역</a></li>
                                <li><a href="<?php echo G5_URL."/page/mypage/viewOrders.php?tab=regform" ?>">주문배송조회</a></li>
                                <li><a href="<?php echo G5_URL."/page/mypage/viewReturn.php?tab=regform" ?>">반품/교환</a></li>
                                <li>1:1 문의</li>
                            </ul>
                        </li>
                        <li><a href="<?php echo G5_BBS_URL."/member_confirm.php?tab=form"?>" >회원탈퇴</a></li>
                        <li class="cont tab"><a href="">마일리지 <span><?php echo $member['mb_point']; ?></span>P</a></li>
                        <li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
                    </ul>   
                </div>        
             </div>
	     </div>	
    </header>
</section>

	<section class="section03">	
		<div class="section01_content wrap">
			<div id="register_form">
				<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="<?php echo $w ?>">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" name="agree" value="<?php echo $agree ?>">
					<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
					<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
					<input type="hidden" name="cert_no" value="">
					<input type="hidden" name="regid" id="regid" value="">
					<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
					<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
					<input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
					<input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
					<input type="hidden" name="mb_mailling" value="1" id="reg_mb_mailling"/>
					<input type="hidden" name="mb_sms" value="1" id="reg_mb_sms" />
					<?php }  ?>
					<div class="form_list01">
					    <h2>회원탈퇴안내</h2>					  
					    <p class="mypageP"><span>> </span>탈퇴후 회원정보 및 개인형 서비스 이용기록은 모두 삭제됩니다. <br>
					    <span>> </span>탈퇴 후에도 게시판형 서비스에 등록한 게시물은 그대로 남아있습니다.</p>					    
						<ul class="borderFirst">					
						<ul style="border-top:none">											
							<li >
								<div>
									<label for="reg_mb_password"><span>*</span> 비밀번호</label>
									<div>
									    <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input01" minlength="8" maxlength="20">									    
								    </div>									
								</div>								
							</li>					
						</ul>
						<div class="btn_group01">								
					         <input type="submit" value="<?php echo '탈퇴하기'; ?>" class="btn color_white grid_30" accesskey="s"style="background:#d81a1a">
						</div>
                    </div>
                    <?php }?>
				</form>
			</div>
		</div>
	</section>	
</div>

<script>


// submit 최종 폼체크

</script>
<!-- } 회원정보 입력/수정 끝 -->