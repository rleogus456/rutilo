<?php
define('_INDEX_', true);
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}
$main=true;
include_once('./_head.php');
$best_tel=sql_fetch("select * from `best_tel`");
$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_event` WHERE  `wr_1`<='$now' and `wr_2`>='$now'";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
	$event_list[]=$event_data;
}
$notice_sql="SELECT * FROM  `g5_write_notice` order by wr_id desc limit 0,5";
$notice_query=sql_query($notice_sql);
while($notice_data=sql_fetch_array($notice_query)){
	$notice_list[]=$notice_data;
}
$best_short=sql_fetch("select * from `best_short`");
?>
<script type="text/javascript">
	$(function(){
		$(".beta a").click(function(){
			$(".beta").fadeOut(500);
		});
	})
</script>
<div class="">
	<?php
	if(defined('_INDEX_')) { // index에서만 실행
		include_once(G5_BBS_PATH.'/newwin.inc.php'); // 팝업레이어
	}
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
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide.jpg"; ?>" alt="rutilo" /></a></div>
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide2.jpg"; ?>" alt="rutilo" /></a></div>
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide3.jpg"; ?>" alt="rutilo" /></a></div>
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide4.jpg"; ?>" alt="rutilo" /></a></div>
	<?php
		}
	?>
	</div>
	<div class="width-fixed">
	<div class="wrap">
		<div id="main_banner">
<!--
			<div class="menu">
				<div >
					<div class="menu1"><div class="bgorange"><a href="<?php echo G5_URL."/page/rent/list.php"; ?>"><?php if($menu1_event['wr_id']){ ?><i class="event"></i><?php } ?><span class="icon"></span><span class="txt"></span></a></div></div>
				</div>
				<div >
				<div class="menu2"><div class="bgyellow"><a href="<?php echo G5_URL."/page/rent/long.php"; ?>"><?php if($menu2_event['wr_id']){ ?><i class="event"></i><?php } ?><span class="icon"></span><span class="txt"></span></a></div></div>
				</div>
				<div>
				    <div class="menu3"><div><a href="<?php echo G5_URL."/page/accident"; ?>"><?php if($menu3_event['wr_id']){ ?><i class="event"></i><?php } ?><span class="icon"></span><span class="txt"></span></a></div></div>
				    <div class="menu4"><div><a href="<?php echo G5_URL."/page/mypage/reserve.php"; ?>"><span class="icon"></span><span class="txt"></span></a></div></div>
				</div>				
			</div>
-->           
        	<div class="menu">
				<div>
					<div class="menu1"><iframe width="100%" height="240px" src="https://www.youtube.com/embed/OKPZPWJUgew" frameborder="0" allowfullscreen></iframe>
					<h1><span class="textRed">| </span>루틸로 No 101</h1>
					<p class="videoText">고품질 놀라운 성능 본  컬러의 색상을 되살린다.</p>
				    </div>
				</div>
				<div >
                    <div class="menu2"><iframe width="100%" height="240px" src="https://www.youtube.com/embed/OKPZPWJUgew" frameborder="0" allowfullscreen></iframe>
                    <h1><span class="textRed">| </span>루틸로 No 201</h1>
                    <p class="videoText">휠의 에너지를 재충전 한다.</p>
                    </div>
				</div>
				<div>
				    <div class="menu3"><iframe width="100%" height="240px" src="https://www.youtube.com/embed/OKPZPWJUgew" frameborder="0" allowfullscreen></iframe>
				    <h1><span class="textRed">| </span>루틸로 No 301</h1>
				    <p class="videoText">새차 같은 컬로톤의 재생, 광택의 스팟이 다르다.</p>
				</div>				   
				</div>				
			</div>									
		</div>	
		</div>
	</div>
</div>
<div id="main_product">
	<div class="width-fixed wrap">
		<div>
			<div class="list">
				<h2>Rutilo</h2>
				<p>새차처럼 보호와 코팅을 한번에!!</p>
				<div>
				<ul>
                    <?php for($i=0;$i<5;$i++){ ?>
                    <li>
                       <a href="#">
                        <div class="img"><div><div><img src="img/intro_logo.png" alt=""></div></div></div>
                        <div class="txt">									
                        <h4>루틸로 101</h4>									
                        <h3>프리미엄 자동차표면 코팅제 all in one(일반용)</h3>	                    							
                        </div>
                        </a>	
                    </li>    
                    <?php }?>
				</ul>
<!--
					<ul>
					<?php
					for($j=0;$j<count($list);$j++){
							$class="";
							if($j>=4)
								$class="md_hidden";
						if($list[$j]["IndexPage"]=="Y"){
					?>
						<li<?=($class?" class='".$class."'":"")?>>
							<a href="<?php echo G5_URL."/page/mall/view.php?&sPID=".$list[$j]['PID']."&sCVIndex=".$list[$j]['CVIndex'] ?>">
								<?php if($list[$j]['out'] || ($list[$j]['number']-$list[$j]['sell'])<=0){ ?><div class="out"><i></i></div><?php } ?>
								<div class="img"><div><div><img src="/shop/images/<?=(strlen($list[$j]['MainImg'])>0?"upload/".$list[$j]['MainImg']:"ProductNoneImage.png")?>" width="100%"></div></div></div>
								<div class="txt">									
									<h4><b><?=(strlen($list[$j]['KrName'])==0?$list[$j]['Name']:$list[$j]['KrName'])?></b></h4>									
									<h3><?=number_format($list[$j]['BZPrice'])?> 원</h3>									
								</div>
							</a>
						</li>
					<?php }
						}
					?>
					</ul>
-->
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
		$partner_sql="SELECT * FROM  `best_event` WHERE  `show` =  '1'";
		$partner_query=sql_query($partner_sql);
		while($partner_data=sql_fetch_array($partner_query)){
			$partner_list[]=$partner_data;
		}
		if(count($partner_list)>0){
	?>
	<div id="main_partner" class="owl-carousel">
	<?php for($i=0;$i<count($partner_list);$i++){ ?>
		<div class="item"><a href="<?=$partner_list[$i]["link"]?>" target="_new"><img src="<?php echo G5_DATA_URL."/partner/".$partner_list[$i]['banner']; ?>" alt="<?php echo $partner_list[$i]['name']; ?>" /></a></div>
	<?php } ?>
	</div>
	<?php } ?>	

<script type="text/javascript">
	$(function () {
		$(".tab_content").hide();
		$(".tab_content:first").show();
		$("#main_tab > div li").click(function () {
			$("#main_tab > div li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		});
	});
	$(function(){
		var owl1=$("#main_event");
		var owl2=$("#main_partner");
		owl1.owlCarousel({
			animateOut: 'fadeOut',
			autoplay:true,
			autoplayTimeout:5000,
			autoplaySpeed:2000,
			smartSpeed:2000,
			loop:true,
			dots:true,
			items:1
		});
		owl2.owlCarousel({
			autoplay:true,
			navText: [ '', '' ],
			autoplayTimeout:5000,
			autoplaySpeed:2000,
			smartSpeed:2000,
			loop:true,
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
<?php
include_once('./_tail.php');
?>
