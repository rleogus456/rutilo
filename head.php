<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}
include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}
$partner=sql_fetch("select * from `best_partner` where mb_id='".$member['mb_id']."'");
$branch=sql_fetch("select * from `best_branch` where mb_id='".$member['mb_id']."'");

?>
<!-- 헤더 시작 -->
<header id="header" class="<?php echo $main?"":"sub_header"; ?>">
	<div id="top_header">
	
	<div class="backRed">
		<div class="width-fixed">
			<?php if($is_member){ ?>
				<p><span></span><?php echo $member['mb_name']; ?> 님 (<?php echo number_format($member['mb_point']); ?>p)</p>
				<ul>                   
                    <?php if(!$is_admin){ ?>
                    <li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>"><img src="img/cart_btn.png" alt="cart"></a></li>       
                    <li><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">정보수정</a></li>
                    <?php }?>
                    <?php if($is_admin || $partner['id'] || $branch['id']){ ?>
                    <li><a href="<?php echo G5_URL."/admin"; ?>">관리자</a></li>
                    <?php } ?>
                    <li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
				</ul>
			<?php }else{ ?>
				<ul>                    
                    <li><a href="<?php echo G5_BBS_URL."/login.php"; ?>">로그인</a> </li>                                        
                    <li><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>">회원가입</a></li>
                    <li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>"><img src="img/cart_btn.png" alt="cart"></a></li>
                    <li class="last">
                       <select name="laguage" id="laguage">
                           <option value="kor">한국어</option>
                       </select>
                    </li>
				</ul>
			<?php } ?>
		</div>
	</div>
	</div>
	
	<div id="main_header">		
		<div class="width-fixed">			
		<h1><a href="<?php echo G5_URL; ?>"></a></h1>	
			<ul>
			<div class="menuLine"></div>
				<li>
				    <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">회사소개</a>                    
				</li>
				<li>
				   <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">제품 소개</a>                     
				     <ul class="subMenu1">
                       <div class="list">
                        <li class="first"><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat02"><img src="img/menuImg1.jpg" alt=""><h2>차량</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat03"><img src="img/menuImg2.jpg" alt=""><h2>선박</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat01"><img src="img/menuImg3.jpg" alt=""><h2>집</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat04"><img src="img/menuImg4.jpg" alt=""><h2>의류</h2></a></li>
                        </div>
                    </ul>                    
				</li>
				<li>
                    <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">시공 방법</a>                    
                </li>
				<li>
                    <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">디테일링 서비스</a>                    
                </li>
				<li>
				    <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">트레이닝 센터</a>
                    <ul class="subMenu2">
                        <div class="list">
                        <li class="first"><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc04"><img src="img/menuImg1.jpg" alt=""><h2>위치지도</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05"><img src="img/menuImg1.jpg" alt=""><h2>트레이너</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05"><img src="img/menuImg1.jpg" alt=""><h2>트레이너 과정</h2></a></li>
                        </div>
                    </ul>
                </li>
				<li>
				    <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">루틸로 협력점</a>
				    <ul class="subMenu3">
				        <div class="list">
						<li class="first"><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc04"><img src="img/menuImg1.jpg" alt=""><h2>가맹문의</h2></a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05"><img src="img/menuImg1.jpg" alt=""><h2>가맹현황</h2></a></li>
                        </div>
				    </ul>
                </li>
				<li>
					<a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">문의 게시판</a>                    
				</li>
			</ul>
		</div>
	</div>
    
	<!-- 모바일 헤더 시작 -->
	<div id="mobile_header">
		<span class="mobile_back_btn"><a href="<?php echo $back_url?$back_url:G5_URL; ?>"></a></span>
		<h1><a href="<?php echo G5_URL; ?>"><span></span></a></h1>
		<span class="mobile_menu_btn"><a href="javascript:"></a></span>
		<!-- 모바일 메뉴 시작 -->
		<div class="mobile_menu">
			<span></span>
			<div>
				<div class="user_box">
					<span></span>
					<p><?php echo $is_member?$member['mb_name']."님 <span>".number_format($member['mb_point'])."p</span>":"로그인해주세요"; ?></p>
					<div>
						<?php if($is_member){ ?>
                            <?php if(!$is_admin) {?> 
                            <a href="<?php echo G5_URL."/page/mypage/cart.php"; ?> " class="bg_darkred color_white btn ">장바구니</a>
                            <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>" class="bg_yellow color_white btn">정보수정</a>
                            <?php }else{?>
                            <a href="<?php echo G5_URL."/page/mypage/reserve.php"; ?> " class="bg_darkred color_white btn mr10">주문확인</a>
                            <?php } ?>
                            <a href="<?php echo G5_BBS_URL."/logout.php"; ?>" class="bg_gray btn">로그아웃</a>
						<?php }else{ ?>
                            <a href="<?php echo G5_BBS_URL."/login.php"; ?>" class="bg_darkred color_white btn">로그인</a>
                            <a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="bg_gray btn ml10">회원가입</a>
						<?php } ?>
					</div>
				</div>
				<ul>
                    <li>
                        <a href="#">회사소개</a>                    
                    </li>
                    <li>
                        <a href="#">제품 소개</a>
                         <ul>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat02">차량</a></li>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat03">선박</a></li>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat01">집</a></li>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat04">의류</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">시공방법</a>				   
                    </li>
                    <li>
                        <a href="#">디테일링 서비스</a>				  
                    </li>
                    <li>
                        <a href="#">트레이닝 센터</a>
                        <ul>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc04">위치지도</a></li>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05">트레이너</a></li>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc06">트레이닝 과정</a></li>				       
                        </ul>
                    </li>
                    <li>
                        <a href="#">루틸로 협력점</a>
                        <ul>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc04">가맹문의</a></li>
                            <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05">가맹현황</a></li>
                        </ul>
                    </li>				    
                    <li>
                        <a href="#">문의게시판</a>
                        <ul>
                            <li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">공지사항</a></li>
                            <li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event"; ?>">이벤트</a></li>
                            <li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=review"; ?>">고객리뷰</a></li>						
                        </ul>
                    </li>			
			    </ul>
			</div>
		</div>
		<!-- 모바일 메뉴 끝 -->
	</div>
	<!-- 모바일 헤더 끝 -->
</header>
<!-- 헤더끝 -->
<div class="msg"></div>
<div class="modal"></div>
<div class="container <?php echo $main?"main":"sub"; ?>">