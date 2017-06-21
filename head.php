<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}
if($is_member){
		$link="javascript:location.href='".G5_URL."/page/mypage/cart.php?tab=form';";
	}else{
		$link="javascript:location.href='".G5_BBS_URL."/login.php?id=".$id."&type=".$type."';";
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
?>
<!-- 헤더 시작 -->
<header id="header" class="<?php echo $main?"":"sub_header"; ?>">
	<div id="top_header">	
	<div class="backRed">
		<div class="width-fixed">
			<?php if($is_member){ ?>
				<ul>        
                   <li><?php echo $member['mb_name']; ?> 님
                       <ul class="mypage">
                          <?php if(!$is_admin){ ?>
                           <li class="mypage"><a href="<?php echo G5_BBS_URL."/register_form.php?tab=form&w=u"; ?>">마이페이지</a></li>
                           <?php }else{?>
                           <li class="mypage"><a href="<?php echo G5_URL."/admin"; ?>">관리페이지</a></li>
                           <?php } ?>
                           <li class="logout"><a href="<?php echo G5_BBS_URL."/logout.php?tab=form"; ?>">로그아웃</a></li>
                           <li class="point"><a href="">마일리지 <span class="red"><?php echo number_format($member['mb_point']); ?>P</span></a></li>
                       </ul>
                   </li>           
                    <?php if(!$is_admin){ ?>
                    <li><a href="<?php echo $link; ?>" class="cart"><img src="<?php echo G5_IMG_URL."/cart_btn.png" ?>" alt="cart"></a></li> 
                    <?php }?>
                      <li class="last">
                       <select name="laguage" id="laguage">
                           <option value="kor">한국어</option>
                       </select>
                    </li>
				</ul>
			<?php }else{ ?>
				<ul>                    
                    <li><a href="<?php echo G5_BBS_URL."/login.php?tab=form"; ?>">로그인</a> </li>                                        
                    <li><a href="<?php echo G5_BBS_URL."/register_form.php?tab=form"; ?>">회원가입</a></li>                    
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
		<div class="imgBack"><h1><a href="<?php echo G5_URL; ?>"></a></h1></div>
			<ul>
			<div class="menuLine"></div>
				<li><a href="<?php echo G5_URL."/page/intro.php?tab=intro"; ?>">회사소개</a></li>
				<li>
				   <a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>">제품 소개</a>                     
				     <ul class="subMenu1">
                       <div class="list">
                        <li class="first"><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>"><img src="<?php echo G5_IMG_URL."/menuImg1.jpg"?>" alt=""><h2>차량</h2></a></li>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>"><img src="<?php echo G5_IMG_URL."/menuImg2.jpg"?>" alt=""><h2>선박</h2></a></li>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>"><img src="<?php echo G5_IMG_URL."/menuImg3.jpg"?>" alt=""><h2>집</h2></a></li>
                        <li><a href="<?php echo G5_URL."/page/product.php?tab=product"; ?>"><img src="<?php echo G5_IMG_URL."/menuImg4.jpg"?>" alt=""><h2>의류</h2></a></li>
                        </div>
                    </ul>                    
				</li>
				<li><a href="<?php echo G5_URL."/page/construction.php?tab=construction"; ?>">시공 방법</a></li>
				<li><a href="<?php echo G5_URL."/page/detailSevice.php?tab=detailSevice"; ?>">디테일링 서비스</a></li>
				<li>
				    <a href="<?php echo G5_URL."/page/trainingCenter.php?tab=center"; ?>">트레이닝 센터</a>
                    <ul class="subMenu2">
                        <div class="list">
                        <li class="first"><a href="<?php echo G5_URL."/page/trainingCenter.php?tab=center"; ?>"><img src=<?php echo G5_IMG_URL."/menuImg1.jpg"?> alt=""><h2>위치지도</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/trainer.php?tab=center"><img src="<?php echo G5_IMG_URL."/menuImg1.jpg"?>" alt=""><h2>트레이너</h2></a></li>
                        <li><a href="<?=G5_URL?>/page/trainingCourse.php?tab=center"><img src="<?php echo G5_IMG_URL."/menuImg1.jpg"?>" alt=""><h2>트레이너 과정</h2></a></li>
                        </div>
                    </ul>
                </li>
				<li>
				    <a href="<?php echo G5_URL."/page/franchisee/franchisee.php?tab=center"; ?>">루틸로 협력점</a>
				    <ul class="subMenu3">
				        <div class="list">
						<li class="first"><a href="<?php echo G5_URL."/page/franchisee/franchisee.php?tab=center"; ?>"><img src="<?php echo G5_IMG_URL."/menuImg1.jpg"?>" alt=""><h2>가맹문의</h2></a></li>
				        <li><a href="<?=G5_URL?>/page/franchisee/franchiseeStatus.php?tab=center"><img src="<?php echo G5_IMG_URL."/menuImg1.jpg"?>" alt=""><h2>가맹현황</h2></a></li>
                        </div>
				    </ul>
                </li>
				<li><a href="<?=G5_BBS_URL?>/board.php?bo_table=questions">문의 게시판</a></li>
			</ul>
		</div>
	</div>
	<!-- 모바일 헤더 시작 -->
	<div id="mobile_header">
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
                            <a href="<?php echo G5_URL."/page/mypage/cart.php?tab=form"; ?> " class="bg_darkred color_white btn ">장바구니</a>
                            <a href="<?php echo G5_BBS_URL."/register_form.php?tab=form&w=u"; ?>" class="bg_yellow color_white btn">정보수정</a>
                            <?php }else{?>
                            <a href="<?php echo G5_URL."/admin"; ?>" class="bg_darkred color_white btn mr10">관리자</a>
                            <?php } ?>
                            <a href="<?php echo G5_BBS_URL."/logout.php"; ?>" class="bg_gray btn">로그아웃</a>
						<?php }else{ ?>
                            <a href="<?php echo G5_BBS_URL."/login.php"; ?>" class="bg_darkred color_white btn">로그인</a>
                            <a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="bg_gray btn ml10">회원가입</a>
						<?php } ?>
					</div>
				</div>
				<ul>
                    <li><a href="<?php echo G5_URL."/page/intro.php?tab=intro"; ?>">회사소개</a></li>
                    <li>
                        <a href="#">제품 소개</a>
                         <ul>
                            <li><a href="<?=G5_URL?>/page/product.php?tab=product">차량</a></li>
                            <li><a href="<?=G5_URL?>/page/product.php?tab=product">선박</a></li>
                            <li><a href="<?=G5_URL?>/page/product.php?tab=product">집</a></li>
                            <li><a href="<?=G5_URL?>/page/product.php?tab=product">의류</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo G5_URL."/page/construction.php?tab=construction"; ?>">시공 방법</a></li>
                    <li><a href="<?php echo G5_URL."/page/detailSevice.php?tab=detailSevice"; ?>">디테일링 서비스</a></li>
                    <li>
                        <a href="#">트레이닝 센터</a>
                        <ul>
                            <li><a href="<?=G5_URL?>/page/trainingCenter.php?tab=center">위치지도</a></li>
                            <li><a href="<?=G5_URL?>/page/trainer.php?tab=center">트레이너</a></li>
                            <li><a href="<?=G5_URL?>/page/trainingCourse.php?tab=center">트레이닝 과정</a></li>				       
                        </ul>
                    </li>
                    <li>
                        <a href="#">루틸로 협력점</a>
                        <ul>
                            <li><a href="<?=G5_URL?>/page/franchisee/franchisee.php?tab=center">가맹문의</a></li>
                            <li><a href="<?=G5_URL?>/page/franchisee/franchiseeStatus.php?tab=center">가맹현황</a></li>
                        </ul>
                    </li>				    
                    <li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=questions"; ?>">문의게시판</a></li>			
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
<div id="main_event" class="owl-carousel">
	<?php
    $slide=sql_fetch("select * from `rutilo_slide` where category='".$tab."'");
		for($i=0;$i<count($event_list);$i++){
			$thumb = get_list_thumbnail("event", $event_list[$i]['wr_id'], 1100, 464);
			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
			}
			if($img_content){ ?>
	    	<div class="item"><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$event_list[$i]['wr_id']; ?>"><?php echo $img_content; ?></a></div>
	<?php	}	}
		if(count($event_list)<=0){?>		
    <?php   if($w=="u"){ ?>
            <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide07.jpg"; ?>" alt="" /></a></div>    
	<?php   }elseif($tab==$slide['category'] && $tab){?> 
	        <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_DATA_URL."/slide/".$slide['photo']; ?>" alt="" /></a></div>
    <?php   } else if($bo_table=="questions"){?>
            <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/slide06.jpg"; ?>" alt="" /></a></div>    
    <?php   } else{?>
            <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide.jpg"; ?>" alt="" /></a></div>
		    <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide2.jpg"; ?>" alt="" /></a></div>
		    <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide3.jpg"; ?>" alt="" /></a></div>
		    <div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide4.jpg"; ?>" alt="" /></a></div>
    <?php   }   }?> 
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
	});
</script>