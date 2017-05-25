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
<style type="text/css">
	.user_box > p > span{background:#757575;color:#fff;display:inline-block;font-size:16px;vertical-align:middle;padding:5px 10px;border-radius:3px;}
</style>
<!-- 헤더 시작 -->
<header id="header" class="<?php echo $main?"":"sub_header"; ?>">
	<div id="top_header">
		<div class="width-fixed">
			<?php if($is_member){ ?>
				<p><span></span><?php echo $member['mb_id']; ?> 님 (<?php echo number_format($member['mb_point']); ?>p)</p>
				<ul>
					<li><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">정보수정</a></li>
					<?php if($is_admin || $partner['id'] || $branch['id']){ ?>
					<li><a href="<?php echo G5_URL."/admin"; ?>">관리자</a></li>
					<?php } ?>
					<li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
				</ul>
			<?php }else{ ?>
				<ul>
					<li><a href="<?php echo G5_BBS_URL."/login.php"; ?>">로그인</a></li>
					<li class="last"><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>">회원가입</a></li>
				</ul>
			<?php } ?>
		</div>
	</div>
	<div id="main_header">
		<div class="width-fixed">
		
			<h1><a href="<?php echo G5_URL; ?>"></a></h1>
			<ul>
<!--				<li><a href="<?php echo G5_URL."/page/intro"; ?>">회사소개</a></li>-->
				<li>
				<a href="<?php echo G5_URL."/page/rent/list.php"; ?>">강아지사료</a>
                    <ul>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog02">습식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog03">건식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog01">간식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog04">영양제</a></li>
                    </ul>
				</li>
				<li>
				   <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">고양이사료</a>
				     <ul>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat02">습식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat03">건식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat01">간식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat04">영양제</a></li>
                    </ul>
				</li>
				<li>
				   <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">애완용품</a>
				    <ul>
			      <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog05">강아지 미용용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog06">강아지 위생용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog07">강아지 의류/패션</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat05">고양이 미용용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat06">고양이 위생용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat07">고양이 미용/패션</a></li>	
				    </ul>
				</li>
				<li>
				    <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">집/용품</a>
				     <ul>
							        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog08">강아지 집/용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat08">고양이 캣타워</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat09">고양이 스크래쳐</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc01">급식기/급수기</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc02">외출용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc03">장난감/훈련용품</a></li>
				    </ul>
				    </li>
				   
				<li>
				<li>
				 <a href="<?php echo G5_URL."/page/rent/list.php"; ?>">기타반려동물 용품</a>
				    <ul>
						<li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc04">가축사료</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05">관상어사료</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc06">수조/장식품/부속품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc07">수질관리/청소기구</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc08">곤충용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc09">조류용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc10">햄스터/토끼용품</a></li>
				    </ul>
				    </li>
				    
				<li>
					<a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">커뮤니티</a>
					<ul>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">공지사항</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event"; ?>">이벤트</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=review"; ?>">고객리뷰</a></li>
					</ul>
				</li>
<!--				<li class="last"><a href="<?php echo G5_URL."/page/partner"; ?>">제휴업체</a></li>-->
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
					<p><?php echo $is_member?$member['mb_id']."님 <span>".number_format($member['mb_point'])."p</span>":"로그인해주세요"; ?></p>
					<div>
						<?php if($is_member){ ?>
						<a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>" class="bg_darkred color_white btn">정보수정</a>
						<a href="<?php echo G5_BBS_URL."/logout.php"; ?>" class="bg_gray btn ml10">로그아웃</a>
						<?php }else{ ?>
						<a href="<?php echo G5_BBS_URL."/login.php"; ?>" class="bg_darkred color_white btn">로그인</a>
						<a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="bg_gray btn ml10">회원가입</a>
						<?php } ?>
					</div>
				</div>
				
				<ul>
<!--				<li><a href="<?php echo G5_URL."/page/intro"; ?>">회사소개</a></li>-->
				<li>
					<a href="#">마이페이지</a>
					<ul>
						<li><a href="<?php echo G5_URL."/page/mypage/cart.php"; ?>">장바구니</a></li>
					
					</ul>
				</li>
				<li>
				<a href="#">강아지사료</a>
                    <ul>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog02">습식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog03">건식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog01">간식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog04">영양제</a></li>
                    </ul>
				</li>
				<li>
				    <a href="#">고양이사료</a>
				     <ul>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat02">습식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat03">건식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat01">간식</a></li>
                        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat04">영양제</a></li>
                    </ul>
				</li>
				<li>
				    <a href="#">애완용품</a>
				    <ul>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog05">강아지 미용용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog06">강아지 위생용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog07">강아지 의류/패션</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat05">고양이 미용용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat06">고양이 위생용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat07">고양이 미용/패션</a></li>				        
				    </ul>
				</li>
				<li>
				    <a href="#">집/용품</a>
				     <ul>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=dog08">강아지 집/용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat08">고양이 캣타워</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=cat09">고양이 스크래쳐</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc01">급식기/급수기</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc02">외출용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc03">장난감/훈련용품</a></li>
				    </ul>
				</li>
				<li>
				    <a href="#">기타반려동물 용품</a>
				    <ul>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc04">가축사료</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc05">관상어사료</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc06">수조/장식품/부속품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc07">수질관리/청소기구</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc08">곤충용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc09">조류용품</a></li>
				        <li><a href="<?=G5_URL?>/page/rent/list.php?type=short&mtype=etc10">햄스터/토끼용품</a></li>
				    </ul>
				</li>				    
				<li>
					<a href="#">커뮤니티</a>
					<ul>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">공지사항</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event"; ?>">이벤트</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=review"; ?>">고객리뷰</a></li>						
					</ul>
				</li>
                <li>
					<a href="#">협력업체</a>
					<ul>
					    <div class="partners">
					        <img src="<?php echo  G5_IMG_URL."/partners01.jpg";?>" alt="partners">
					    </div>
					    <div class="partners">
					        <img src="<?php echo  G5_IMG_URL."/partners03.jpg";?>" alt="1">
					    </div>
<!--
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">공지사항</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event"; ?>">이벤트</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=review"; ?>">고객리뷰</a></li>
-->
					</ul>
				</li>
				
<!--				<li class="last"><a href="<?php echo G5_URL."/page/partner"; ?>">제휴업체</a></li>-->
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

